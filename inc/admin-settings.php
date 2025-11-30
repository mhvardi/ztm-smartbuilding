<?php
/**
 * پنل تنظیمات قالب در پیشخوان (بدون ACF)
 */

add_action('admin_menu', function(){
  add_menu_page(
    'تنظیمات قالب زرین',
    'تنظیمات قالب زرین',
    'manage_options',
    'ztm-theme-settings',
    'ztm_render_settings_page',
    'dashicons-admin-customizer',
    61
  );
});

add_action('admin_init', function(){
  register_setting('ztm_settings_group', 'ztm_settings', [
    'sanitize_callback' => 'ztm_sanitize_settings',
  ]);

  add_settings_section('ztm_sec_brand', 'هویت بصری', '__return_false', 'ztm-theme-settings');
  add_settings_section('ztm_sec_home', 'صفحه اصلی', '__return_false', 'ztm-theme-settings');
  add_settings_section('ztm_sec_bands', 'سکشن‌های ویژه (اپل‌مانند)', '__return_false', 'ztm-theme-settings');
  add_settings_section('ztm_sec_explore', 'کارت‌های Explore', '__return_false', 'ztm-theme-settings');
  add_settings_section('ztm_sec_contact', 'اطلاعات تماس', '__return_false', 'ztm-theme-settings');

  // Fields helper
  $fields = [
    // brand/company
    ['key'=>'company_name','label'=>'نام شرکت','section'=>'ztm_sec_brand','type'=>'text','default'=>'زرین تجارت مبنا'],
    ['key'=>'company_intro','label'=>'معرفی کوتاه','section'=>'ztm_sec_brand','type'=>'textarea','default'=>'مشاوره، طراحی، تأمین کالا، اجرا و خدمات پس از فروش سیستم های هوشمندسازی ساختمان، حفاظتی و نظارتی، امنیتی و UPS'],
    ['key'=>'logo_url','label'=>'آدرس لوگو (URL)','section'=>'ztm_sec_brand','type'=>'url','default'=>'https://smartztm.com/wp-content/uploads/2024/12/ztm.png'],
    ['key'=>'primary_green','label'=>'رنگ سبز اصلی','section'=>'ztm_sec_brand','type'=>'color','default'=>'#0db14c'],
    ['key'=>'primary_blue','label'=>'رنگ آبی اصلی','section'=>'ztm_sec_brand','type'=>'color','default'=>'#006cb6'],
    ['key'=>'neutral_gray','label'=>'رنگ خاکستری خنثی','section'=>'ztm_sec_brand','type'=>'color','default'=>'#8e979e'],

    // hero
    ['key'=>'hero_enable','label'=>'فعال بودن هرو تمام‌صفحه','section'=>'ztm_sec_home','type'=>'checkbox','default'=>1],
    ['key'=>'hero_title','label'=>'تیتر هرو','section'=>'ztm_sec_home','type'=>'text','default'=>'هوشمندسازی ساختمان، ساده و لوکس'],
    ['key'=>'hero_sub','label'=>'زیرتیتر هرو','section'=>'ztm_sec_home','type'=>'textarea','default'=>'راهکارهای هوشمند برای ساختمان‌های مدرن و آینده‌نگر.'],
    ['key'=>'hero_media','label'=>'آدرس ویدئو/تصویر هرو (URL)','section'=>'ztm_sec_home','type'=>'url','default'=>'https://videos.pexels.com/video-files/3209829/3209829-hd_1920_1080_25fps.mp4'],
    ['key'=>'hero_cta_label','label'=>'متن دکمه هرو','section'=>'ztm_sec_home','type'=>'text','default'=>'درخواست مشاوره'],
    ['key'=>'hero_cta_link','label'=>'لینک دکمه هرو','section'=>'ztm_sec_home','type'=>'text','default'=>'/contact'],

    // bands 1..3
  ];

  for($i=1,$order=0;$i<=3;$i++){
    $fields[] = ['key'=>"band{$i}_enable",'label'=>"فعال بودن سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'checkbox','default'=>($i==1?1:0)];
    $fields[] = ['key'=>"band{$i}_style",'label'=>"استایل سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'select','choices'=>['dark'=>'تیره','light'=>'روشن'],'default'=>($i==1?'dark':'light')];
    $fields[] = ['key'=>"band{$i}_title",'label'=>"تیتر سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'text','default'=>($i==1?'هوشمندسازی که حس آینده می‌دهد':'یکی از راهکارهای ویژه ما')];
    $fields[] = ['key'=>"band{$i}_sub",'label'=>"توضیح سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'textarea','default'=>($i==1?'کنترل یکپارچه روشنایی، تهویه، پرده‌ها و سناریوها با طراحی لوکس و عملکرد بی‌نقص.':'توضیح کوتاه برای معرفی این سرویس یا محصول.')];
    $fields[] = ['key'=>"band{$i}_media",'label'=>"آدرس ویدئو/تصویر سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'url','default'=>''];
    $fields[] = ['key'=>"band{$i}_cta_label",'label'=>"متن دکمه سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'text','default'=>'بیشتر بدانید'];
    $fields[] = ['key'=>"band{$i}_cta_link",'label'=>"لینک دکمه سکشن {$i}",'section'=>'ztm_sec_bands','type'=>'text','default'=>'/services'];
  }

  // explore cards 1..4
  for($i=1;$i<=4;$i++){
    $fields[] = ['key'=>"explore{$i}_enable",'label'=>"فعال بودن کارت Explore {$i}",'section'=>'ztm_sec_explore','type'=>'checkbox','default'=>1];
    $fields[] = ['key'=>"explore{$i}_style",'label'=>"استایل کارت {$i}",'section'=>'ztm_sec_explore','type'=>'select','choices'=>['dark'=>'تیره','light'=>'روشن'],'default'=>($i%2==1?'dark':'light')];
    $fields[] = ['key'=>"explore{$i}_title",'label'=>"تیتر کارت {$i}",'section'=>'ztm_sec_explore','type'=>'text','default'=>'عنوان کارت'];
    $fields[] = ['key'=>"explore{$i}_sub",'label'=>"توضیح کارت {$i}",'section'=>'ztm_sec_explore','type'=>'textarea','default'=>'توضیح کوتاه کارت Explore.'];
    $fields[] = ['key'=>"explore{$i}_media",'label'=>"آدرس تصویر کارت {$i}",'section'=>'ztm_sec_explore','type'=>'url','default'=>''];
    $fields[] = ['key'=>"explore{$i}_cta_label",'label'=>"متن دکمه کارت {$i}",'section'=>'ztm_sec_explore','type'=>'text','default'=>'مشاهده'];
    $fields[] = ['key'=>"explore{$i}_cta_link",'label'=>"لینک دکمه کارت {$i}",'section'=>'ztm_sec_explore','type'=>'text','default'=>'/services'];
  }

  // contact
  $fields += [
    ['key'=>'phone','label'=>'تلفن','section'=>'ztm_sec_contact','type'=>'text','default'=>''],
    ['key'=>'email','label'=>'ایمیل','section'=>'ztm_sec_contact','type'=>'text','default'=>''],
    ['key'=>'address','label'=>'آدرس','section'=>'ztm_sec_contact','type'=>'textarea','default'=>''],
  ];

  foreach($fields as $f){
    add_settings_field(
      'ztm_'.$f['key'],
      $f['label'],
      'ztm_render_field',
      'ztm-theme-settings',
      $f['section'],
      $f
    );
  }
});

function ztm_sanitize_settings($input){
  $out = [];
  foreach((array)$input as $k=>$v){
    if(is_string($v)) $out[$k] = wp_kses_post($v);
    else $out[$k] = $v;
  }
  return $out;
}

function ztm_get_settings(){
  $opt = get_option('ztm_settings', []);
  return is_array($opt) ? $opt : [];
}

function ztm_render_field($args){
  $opt = ztm_get_settings();
  $key = $args['key'];
  $type = $args['type'] ?? 'text';
  $val = $opt[$key] ?? ($args['default'] ?? '');
  $name = "ztm_settings[$key]";

  switch($type){
    case 'textarea':
      echo '<textarea name="'.esc_attr($name).'" rows="3" style="width:100%">'.esc_textarea($val).'</textarea>';
      break;
    case 'checkbox':
      echo '<label><input type="checkbox" name="'.esc_attr($name).'" value="1" '.checked($val,1,false).'> فعال</label>';
      break;
    case 'color':
      echo '<input type="text" class="ztm-color" name="'.esc_attr($name).'" value="'.esc_attr($val).'" data-default-color="'.esc_attr($args['default']).'">';
      break;
    case 'select':
      echo '<select name="'.esc_attr($name).'" style="width:200px">';
      foreach(($args['choices']??[]) as $ck=>$cl){
        echo '<option value="'.esc_attr($ck).'" '.selected($val,$ck,false).'>'.esc_html($cl).'</option>';
      }
      echo '</select>';
      break;
    default:
      echo '<input type="'.esc_attr($type).'" name="'.esc_attr($name).'" value="'.esc_attr($val).'" style="width:100%">';
  }
}

function ztm_render_settings_page(){
  ?>
  <div class="wrap">
    <h1>تنظیمات قالب زرین</h1>
    <p>تمام بخش‌های قالب از این صفحه مدیریت می‌شوند. برای ذخیره تغییرات روی «ذخیره» کلیک کنید.</p>
    <form method="post" action="options.php">
      <?php settings_fields('ztm_settings_group'); ?>
      <?php do_settings_sections('ztm-theme-settings'); ?>
      <?php submit_button('ذخیره تنظیمات'); ?>
    </form>
  </div>
  <?php
}

add_action('admin_enqueue_scripts', function($hook){
  if($hook !== 'toplevel_page_ztm-theme-settings') return;
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_script('wp-color-picker');
  wp_add_inline_script('wp-color-picker', 'jQuery(function($){$(".ztm-color").wpColorPicker();});');
});
