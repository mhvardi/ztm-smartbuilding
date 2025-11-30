<?php ?><!doctype html>
<html <?php language_attributes(); ?> dir="<?php echo is_rtl()?'rtl':'ltr'; ?>">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <style>
    :root{
      --green: <?php echo esc_html(ztm_get_option('primary_green','#0db14c')); ?>;
      --blue: <?php echo esc_html(ztm_get_option('primary_blue','#006cb6')); ?>;
      --gray: <?php echo esc_html(ztm_get_option('neutral_gray','#8e979e')); ?>;
    }
  </style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="<?php echo esc_url(home_url('/')); ?>">
      <?php $logo=ztm_get_option('logo_url'); if($logo): ?>
        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(ztm_get_option('company_name','زرین تجارت مبنا')); ?>">
      <?php endif; ?>
      <span><?php echo esc_html(ztm_get_option('company_name','زرین تجارت مبنا')); ?></span>
    </a>

    <nav class="nav" aria-label="ناوبری اصلی">
      <button class="nav-toggle" aria-expanded="false" aria-controls="primary-menu">☰</button>
      <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_id'=>'primary-menu','fallback_cb'=>'__return_false']); ?>
    </nav>
  </div>
</header>

<main id="content">
