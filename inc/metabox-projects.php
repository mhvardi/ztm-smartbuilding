<?php
add_action('add_meta_boxes', function(){
  add_meta_box('ztm_project_meta','اطلاعات پروژه','ztm_project_meta_cb','ztm_project','normal','high');
});
function ztm_project_meta_cb($post){
  wp_nonce_field('ztm_project_meta_save','ztm_project_meta_nonce');
  $client=get_post_meta($post->ID,'_ztm_client',true);
  $location=get_post_meta($post->ID,'_ztm_location',true);
  $date=get_post_meta($post->ID,'_ztm_execution_date',true);
  $services=get_post_meta($post->ID,'_ztm_services_done',true); if(!is_array($services)) $services=[];
?>
<p><label>کارفرما</label><br><input name="ztm_client" value="<?php echo esc_attr($client); ?>" style="width:100%"></p>
<p><label>موقعیت/شهر</label><br><input name="ztm_location" value="<?php echo esc_attr($location); ?>" style="width:100%"></p>
<p><label>تاریخ اجرا</label><br><input name="ztm_execution_date" value="<?php echo esc_attr($date); ?>" style="width:100%"></p>
<hr><h4>خدمات انجام شده (هر خط یک مورد)</h4>
<textarea name="ztm_services_done" rows="5" style="width:100%"><?php echo esc_textarea(implode("
",$services)); ?></textarea>
<?php }
add_action('save_post_ztm_project', function($post_id){
  if(!isset($_POST['ztm_project_meta_nonce'])||!wp_verify_nonce($_POST['ztm_project_meta_nonce'],'ztm_project_meta_save')) return;
  if(defined('DOING_AUTOSAVE')&&DOING_AUTOSAVE) return;
  if(!current_user_can('edit_post',$post_id)) return;
  update_post_meta($post_id,'_ztm_client',sanitize_text_field($_POST['ztm_client']??''));
  update_post_meta($post_id,'_ztm_location',sanitize_text_field($_POST['ztm_location']??''));
  update_post_meta($post_id,'_ztm_execution_date',sanitize_text_field($_POST['ztm_execution_date']??''));
  $raw=sanitize_textarea_field($_POST['ztm_services_done']??''); $arr=[];
  foreach(preg_split("/
|
|/",$raw) as $l){$l=trim($l); if($l) $arr[]=$l;}
  update_post_meta($post_id,'_ztm_services_done',$arr);
});
