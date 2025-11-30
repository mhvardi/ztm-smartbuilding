<?php
/**
 * Home Sections Builder (سبک و مشابه المنتور برای صفحه اصلی)
 * CPT: ztm_section
 * مرتب‌سازی با menu_order (Drag & Drop)
 */

add_action('init', function(){
  register_post_type('ztm_section', [
    'labels' => [
      'name' => 'سکشن‌های صفحه اصلی',
      'singular_name' => 'سکشن',
      'menu_name' => 'سکشن‌های صفحه اصلی',
      'add_new_item' => 'افزودن سکشن',
      'edit_item' => 'ویرایش سکشن',
      'not_found' => 'سکشنی یافت نشد',
    ],
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => 'ztm-theme-settings',
    'supports' => ['title','page-attributes'],
    'menu_icon' => 'dashicons-screenoptions',
  ]);
});

add_action('add_meta_boxes', function(){
  add_meta_box('ztm_section_meta','تنظیمات سکشن','ztm_section_meta_cb','ztm_section','normal','high');
});

function ztm_section_meta_cb($post){
  $type  = get_post_meta($post->ID,'_ztm_type',true) ?: 'band';
  $style = get_post_meta($post->ID,'_ztm_style',true) ?: 'light';
  $title = get_post_meta($post->ID,'_ztm_title',true);
  $sub   = get_post_meta($post->ID,'_ztm_sub',true);
  $media = get_post_meta($post->ID,'_ztm_media',true);
  $cta1_label = get_post_meta($post->ID,'_ztm_cta1_label',true);
  $cta1_link  = get_post_meta($post->ID,'_ztm_cta1_link',true);
  $cta2_label = get_post_meta($post->ID,'_ztm_cta2_label',true);
  $cta2_link  = get_post_meta($post->ID,'_ztm_cta2_link',true);
  $enabled = get_post_meta($post->ID,'_ztm_enabled',true);
  wp_nonce_field('ztm_section_save','ztm_section_nonce');
  ?>
  <p>
    <label>فعال باشد؟</label>
    <input type="checkbox" name="ztm_enabled" value="1" <?php checked($enabled,1); ?>>
  </p>
  <p>
    <label>نوع سکشن</label><br>
    <select name="ztm_type">
      <option value="hero" <?php selected($type,'hero'); ?>>هرو (لوگو موشن)</option>
      <option value="band" <?php selected($type,'band'); ?>>Band تمام‌عرض</option>
      <option value="explore" <?php selected($type,'explore'); ?>>کارت‌های Explore/Services</option>
      <option value="projects" <?php selected($type,'projects'); ?>>پروژه‌های منتخب</option>
      <option value="products" <?php selected($type,'products'); ?>>محصولات منتخب</option>
      <option value="contact" <?php selected($type,'contact'); ?>>درخواست مشاوره</option>
    </select>
  </p>
  <p>
    <label>استایل</label><br>
    <select name="ztm_style">
      <option value="light" <?php selected($style,'light'); ?>>روشن</option>
      <option value="dark" <?php selected($style,'dark'); ?>>تیره</option>
    </select>
  </p>
  <p><label>تیتر</label><br><input style="width:100%" name="ztm_title" value="<?php echo esc_attr($title); ?>"></p>
  <p><label>توضیح کوتاه</label><br><textarea style="width:100%" rows="3" name="ztm_sub"><?php echo esc_textarea($sub); ?></textarea></p>
  <p><label>آدرس تصویر/PNG/ویدئو (URL)</label><br><input style="width:100%" name="ztm_media" value="<?php echo esc_attr($media); ?>"></p>
  <hr>
  <p><label>دکمه ۱ - متن</label><br><input style="width:100%" name="ztm_cta1_label" value="<?php echo esc_attr($cta1_label); ?>"></p>
  <p><label>دکمه ۱ - لینک</label><br><input style="width:100%" name="ztm_cta1_link" value="<?php echo esc_attr($cta1_link); ?>"></p>
  <p><label>دکمه ۲ - متن</label><br><input style="width:100%" name="ztm_cta2_label" value="<?php echo esc_attr($cta2_label); ?>"></p>
  <p><label>دکمه ۲ - لینک</label><br><input style="width:100%" name="ztm_cta2_link" value="<?php echo esc_attr($cta2_link); ?>"></p>
  <p class="small">ترتیب نمایش را در لیست «سکشن‌های صفحه اصلی» با Drag & Drop (ستون ترتیب) تغییر دهید.</p>
  <?php
}

add_action('save_post_ztm_section', function($post_id){
  if(!isset($_POST['ztm_section_nonce']) || !wp_verify_nonce($_POST['ztm_section_nonce'],'ztm_section_save')) return;
  update_post_meta($post_id,'_ztm_enabled', isset($_POST['ztm_enabled'])?1:0);
  foreach([
    'ztm_type'=>'_ztm_type',
    'ztm_style'=>'_ztm_style',
    'ztm_title'=>'_ztm_title',
    'ztm_sub'=>'_ztm_sub',
    'ztm_media'=>'_ztm_media',
    'ztm_cta1_label'=>'_ztm_cta1_label',
    'ztm_cta1_link'=>'_ztm_cta1_link',
    'ztm_cta2_label'=>'_ztm_cta2_label',
    'ztm_cta2_link'=>'_ztm_cta2_link',
  ] as $k=>$meta){
    if(isset($_POST[$k])) update_post_meta($post_id,$meta, sanitize_text_field($_POST[$k]));
  }
});
