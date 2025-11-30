<?php
if (!defined('ZTM_THEME_VERSION')) {
  define('ZTM_THEME_VERSION', '1.7.0');
}

add_action('after_setup_theme', function () {
  load_theme_textdomain('ztm-smartbuilding', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);

  register_nav_menus([
    'primary' => 'منوی اصلی',
    'footer'  => 'منوی فوتر',
  ]);
});

add_action('wp_enqueue_scripts', function () {
  $uri = get_template_directory_uri();

  wp_enqueue_style('ztm-style', get_stylesheet_uri(), [], ZTM_THEME_VERSION);
  wp_enqueue_style('ztm-aos', 'https://unpkg.com/aos@2.3.4/dist/aos.css', [], '2.3.4');

  wp_enqueue_script('ztm-aos', 'https://unpkg.com/aos@2.3.4/dist/aos.js', [], '2.3.4', true);

  // GSAP + ScrollTrigger برای Parallax و انیمیشن‌های اپل‌مانند
  wp_enqueue_script('ztm-gsap', 'https://unpkg.com/gsap@3.12.5/dist/gsap.min.js', [], '3.12.5', true);
  wp_enqueue_script('ztm-scrolltrigger', 'https://unpkg.com/gsap@3.12.5/dist/ScrollTrigger.min.js', ['ztm-gsap'], '3.12.5', true);

  wp_enqueue_script('ztm-main', $uri . '/assets/js/main.js', ['ztm-aos','ztm-scrolltrigger'], ZTM_THEME_VERSION, true);
});

add_filter('body_class', function($classes){
  $classes[] = is_rtl() ? 'rtl' : 'ltr';
  return $classes;
});

add_action('widgets_init', function(){
  register_sidebar([
    'name' => 'سایدبار',
    'id' => 'sidebar-1',
    'before_widget' => '<div class="card widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ]);
});

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/admin-settings.php';
require_once get_template_directory() . '/inc/sections-builder.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/cpt-products.php';
require_once get_template_directory() . '/inc/cpt-projects.php';
require_once get_template_directory() . '/inc/metabox-products.php';
require_once get_template_directory() . '/inc/metabox-projects.php';
require_once get_template_directory() . '/inc/leads.php';
