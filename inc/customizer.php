<?php
add_action('customize_register', function($wp_customize){

  $wp_customize->add_panel('ztm_theme_panel', [
    'title' => 'تنظیمات قالب',
    'priority' => 10,
  ]);

  $wp_customize->add_section('ztm_branding', [
    'title' => 'هویت بصری و رنگ‌ها',
    'panel' => 'ztm_theme_panel',
    'priority' => 10,
  ]);

  $wp_customize->add_setting('ztm_primary_green', ['default'=>'#0db14c','sanitize_callback'=>'sanitize_hex_color']);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ztm_primary_green',[
    'label'=>'رنگ اصلی سبز','section'=>'ztm_branding'
  ]));

  $wp_customize->add_setting('ztm_primary_blue', ['default'=>'#006cb6','sanitize_callback'=>'sanitize_hex_color']);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ztm_primary_blue',[
    'label'=>'رنگ اصلی آبی','section'=>'ztm_branding'
  ]));

  $wp_customize->add_setting('ztm_neutral_gray', ['default'=>'#8e979e','sanitize_callback'=>'sanitize_hex_color']);
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'ztm_neutral_gray',[
    'label'=>'رنگ خنثی خاکستری','section'=>'ztm_branding'
  ]));

  $wp_customize->add_section('ztm_company', [
    'title' => 'اطلاعات شرکت',
    'panel' => 'ztm_theme_panel',
    'priority' => 20,
  ]);

  $wp_customize->add_setting('ztm_logo_url', ['default'=>'https://smartztm.com/wp-content/uploads/2024/12/ztm.png','sanitize_callback'=>'esc_url_raw']);
  $wp_customize->add_control('ztm_logo_url', ['label'=>'آدرس لوگو (URL)','section'=>'ztm_company','type'=>'url']);

  $wp_customize->add_setting('ztm_company_name', ['default'=>'زرین تجارت مبنا','sanitize_callback'=>'sanitize_text_field']);
  $wp_customize->add_control('ztm_company_name', ['label'=>'نام شرکت','section'=>'ztm_company','type'=>'text']);

  $wp_customize->add_setting('ztm_company_short_intro', [
    'default'=>'مشاوره، طراحی، تأمین کالا، اجرا و خدمات پس از فروش سیستم های هوشمندسازی ساختمان، حفاظتی و نظارتی، امنیتی و UPS',
    'sanitize_callback'=>'wp_kses_post'
  ]);
  $wp_customize->add_control('ztm_company_short_intro', ['label'=>'معرفی کوتاه','section'=>'ztm_company','type'=>'textarea']);

  $wp_customize->add_section('ztm_home', [
    'title' => 'صفحه اصلی',
    'panel' => 'ztm_theme_panel',
    'priority' => 30,
  ]);

  $wp_customize->add_setting('ztm_home_hero_enable', ['default'=>true,'sanitize_callback'=>'rest_sanitize_boolean']);
  $wp_customize->add_control('ztm_home_hero_enable', ['label'=>'فعال بودن سکشن هرو','section'=>'ztm_home','type'=>'checkbox']);

  $wp_customize->add_setting('ztm_home_hero_title', ['default'=>'هوشمندسازی ساختمان، ساده و لوکس','sanitize_callback'=>'sanitize_text_field']);
  $wp_customize->add_control('ztm_home_hero_title', ['label'=>'تیتر هرو','section'=>'ztm_home','type'=>'text']);

  $wp_customize->add_setting('ztm_home_hero_sub', ['default'=>'راهکارهای هوشمند برای ساختمان‌های مدرن و آینده‌نگر.','sanitize_callback'=>'sanitize_textarea_field']);
  $wp_customize->add_control('ztm_home_hero_sub', ['label'=>'زیرتیتر هرو','section'=>'ztm_home','type'=>'textarea']);

  $wp_customize->add_setting('ztm_home_hero_cta_label', ['default'=>'درخواست مشاوره','sanitize_callback'=>'sanitize_text_field']);
  $wp_customize->add_control('ztm_home_hero_cta_label', ['label'=>'متن دکمه اصلی هرو','section'=>'ztm_home','type'=>'text']);

  $wp_customize->add_setting('ztm_home_hero_cta_link', ['default'=>'/contact','sanitize_callback'=>'sanitize_text_field']);
  $wp_customize->add_control('ztm_home_hero_cta_link', ['label'=>'لینک دکمه اصلی هرو (Relative)','section'=>'ztm_home','type'=>'text']);

  $wp_customize->add_setting('ztm_home_services_enable', ['default'=>true,'sanitize_callback'=>'rest_sanitize_boolean']);
  $wp_customize->add_control('ztm_home_services_enable', ['label'=>'فعال بودن سکشن خدمات','section'=>'ztm_home','type'=>'checkbox']);

  // سکشن‌های ویژه مشابه اپل
  $wp_customize->add_section('ztm_bands', [
    'title' => 'سکشن‌های ویژه (مشابه اپل)',
    'panel' => 'ztm_theme_panel',
    'priority' => 35,
  ]);

  for($i=1;$i<=3;$i++){
    $wp_customize->add_setting("ztm_band_{$i}_enable", ['default'=>($i==1),'sanitize_callback'=>'rest_sanitize_boolean']);
    $wp_customize->add_control("ztm_band_{$i}_enable", [
      'label'=>"فعال بودن سکشن ویژه {$i}",
      'section'=>'ztm_bands','type'=>'checkbox'
    ]);

    $wp_customize->add_setting("ztm_band_{$i}_style", ['default'=>($i==1?'dark':'light'),'sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control("ztm_band_{$i}_style", [
      'label'=>"استایل سکشن {$i} (روشن/تیره)",
      'section'=>'ztm_bands','type'=>'select',
      'choices'=>['dark'=>'تیره','light'=>'روشن']
    ]);

    $wp_customize->add_setting("ztm_band_{$i}_title", ['default'=>'تیتر سکشن ویژه','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control("ztm_band_{$i}_title", ['label'=>"تیتر سکشن {$i}",'section'=>'ztm_bands','type'=>'text']);

    $wp_customize->add_setting("ztm_band_{$i}_sub", ['default'=>'توضیح کوتاه سکشن ویژه','sanitize_callback'=>'sanitize_textarea_field']);
    $wp_customize->add_control("ztm_band_{$i}_sub", ['label'=>"توضیح سکشن {$i}",'section'=>'ztm_bands','type'=>'textarea']);

    $wp_customize->add_setting("ztm_band_{$i}_media", ['default'=>'','sanitize_callback'=>'esc_url_raw']);
    $wp_customize->add_control("ztm_band_{$i}_media", [
      'label'=>"آدرس تصویر/ویدئو سکشن {$i} (URL)",
      'section'=>'ztm_bands','type'=>'url'
    ]);

    $wp_customize->add_setting("ztm_band_{$i}_cta_label", ['default'=>'بیشتر بدانید','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control("ztm_band_{$i}_cta_label", ['label'=>"متن دکمه سکشن {$i}",'section'=>'ztm_bands','type'=>'text']);

    $wp_customize->add_setting("ztm_band_{$i}_cta_link", ['default'=>'/services','sanitize_callback'=>'sanitize_text_field']);
    $wp_customize->add_control("ztm_band_{$i}_cta_link", ['label'=>"لینک دکمه سکشن {$i}",'section'=>'ztm_bands','type'=>'text']);
  }

  $wp_customize->add_setting('ztm_home_projects_enable', ['default'=>true,'sanitize_callback'=>'rest_sanitize_boolean']);
  $wp_customize->add_control('ztm_home_projects_enable', ['label'=>'فعال بودن سکشن پروژه‌ها','section'=>'ztm_home','type'=>'checkbox']);

  $wp_customize->add_setting('ztm_home_products_enable', ['default'=>true,'sanitize_callback'=>'rest_sanitize_boolean']);
  $wp_customize->add_control('ztm_home_products_enable', ['label'=>'فعال بودن سکشن محصولات','section'=>'ztm_home','type'=>'checkbox']);

  $wp_customize->add_setting('ztm_home_contact_enable', ['default'=>true,'sanitize_callback'=>'rest_sanitize_boolean']);
  $wp_customize->add_control('ztm_home_contact_enable', ['label'=>'فعال بودن سکشن تماس/مشاوره','section'=>'ztm_home','type'=>'checkbox']);

  $wp_customize->add_section('ztm_contact', [
    'title' => 'اطلاعات تماس',
    'panel' => 'ztm_theme_panel',
    'priority' => 40,
  ]);

  $wp_customize->add_setting('ztm_contact_phone', ['default'=>'','sanitize_callback'=>'sanitize_text_field']);
  $wp_customize->add_control('ztm_contact_phone', ['label'=>'تلفن','section'=>'ztm_contact','type'=>'text']);

  $wp_customize->add_setting('ztm_contact_email', ['default'=>'','sanitize_callback'=>'sanitize_email']);
  $wp_customize->add_control('ztm_contact_email', ['label'=>'ایمیل','section'=>'ztm_contact','type'=>'email']);

  $wp_customize->add_setting('ztm_contact_address', ['default'=>'','sanitize_callback'=>'sanitize_textarea_field']);
  $wp_customize->add_control('ztm_contact_address', ['label'=>'آدرس','section'=>'ztm_contact','type'=>'textarea']);
});
