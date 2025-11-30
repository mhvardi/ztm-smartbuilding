<?php
add_action('add_meta_boxes', function(){
  add_meta_box('ztm_product_meta','اطلاعات محصول','ztm_product_meta_cb','ztm_product','normal','high');
});
function ztm_product_meta_cb($post){
  wp_nonce_field('ztm_product_meta_save','ztm_product_meta_nonce');
  $price=get_post_meta($post->ID,'_ztm_price',true);
  $stock=get_post_meta($post->ID,'_ztm_stock',true);
  $pdf=get_post_meta($post->ID,'_ztm_pdf',true);
  $specs=get_post_meta($post->ID,'_ztm_specs',true); if(!is_array($specs)) $specs=[];
?>
<p><label>قیمت (اختیاری)</label><br><input name="ztm_price" value="<?php echo esc_attr($price); ?>" style="width:100%"></p>
<p><label>وضعیت موجودی</label><br>
<select name="ztm_stock" style="width:100%">
  <option value="" <?php selected($stock,''); ?>>نامشخص</option>
  <option value="in_stock" <?php selected($stock,'in_stock'); ?>>موجود</option>
  <option value="out_stock" <?php selected($stock,'out_stock'); ?>>ناموجود</option>
  <option value="special" <?php selected($stock,'special'); ?>>ویژه</option>
</select></p>
<p><label>لینک PDF کاتالوگ</label><br><input type="url" name="ztm_pdf" value="<?php echo esc_attr($pdf); ?>" style="width:100%"></p>
<hr><h4>مشخصات فنی (هر خط: عنوان | مقدار)</h4>
<textarea name="ztm_specs" rows="6" style="width:100%"><?php
  $lines=[]; foreach($specs as $r){$lines[] = ($r['label']??'').' | '.($r['value']??'');}
  echo esc_textarea(implode("
",$lines));
?></textarea>
<?php }
add_action('save_post_ztm_product', function($post_id){
  if(!isset($_POST['ztm_product_meta_nonce'])||!wp_verify_nonce($_POST['ztm_product_meta_nonce'],'ztm_product_meta_save')) return;
  if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE) return;
  if(!current_user_can('edit_post',$post_id)) return;
  update_post_meta($post_id,'_ztm_price',sanitize_text_field($_POST['ztm_price']??''));
  update_post_meta($post_id,'_ztm_stock',sanitize_text_field($_POST['ztm_stock']??''));
  update_post_meta($post_id,'_ztm_pdf',esc_url_raw($_POST['ztm_pdf']??''));
  $raw=sanitize_textarea_field($_POST['ztm_specs']??''); $specs=[];
  foreach(preg_split("/
|
|/",$raw) as $line){
    $line=trim($line); if(!$line) continue;
    if(strpos($line,'|')!==false){[$l,$v]=array_map('trim',explode('|',$line,2));}
    else{$l=$line;$v='';}
    $specs[]=['label'=>$l,'value'=>$v];
  }
  update_post_meta($post_id,'_ztm_specs',$specs);
});
