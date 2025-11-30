<?php get_header(); ?>

<?php
$sections = new WP_Query([
  'post_type' => 'ztm_section',
  'posts_per_page' => -1,
  'orderby' => 'menu_order',
  'order' => 'ASC',
]);
if($sections->have_posts()):
  while($sections->have_posts()): $sections->the_post();
    $id = get_the_ID();
    $enabled = get_post_meta($id,'_ztm_enabled',true);
    if(!$enabled) continue;
    $type  = get_post_meta($id,'_ztm_type',true) ?: 'band';
    $style = get_post_meta($id,'_ztm_style',true) ?: 'light';
    $title = get_post_meta($id,'_ztm_title',true) ?: get_the_title();
    $sub   = get_post_meta($id,'_ztm_sub',true);
    $media = get_post_meta($id,'_ztm_media',true);
    $cta1_label = get_post_meta($id,'_ztm_cta1_label',true);
    $cta1_link  = get_post_meta($id,'_ztm_cta1_link',true);
    $cta2_label = get_post_meta($id,'_ztm_cta2_label',true);
    $cta2_link  = get_post_meta($id,'_ztm_cta2_link',true);

    // HERO with logo motion
    if($type==='hero'):
      $logo = $media ?: ztm_get_option('logo_url');
?>
<section class="logo-hero parallax-wrap">
  <div class="container" data-aos="fade-up">
    <div class="logo-wrap" data-logo-motion>
      <?php if($logo): ?><img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(ztm_get_option('company_name','زرین تجارت مبنا')); ?>"><?php endif; ?>
    </div>
    <h1 data-reveal><?php echo esc_html($title); ?></h1>
    <?php if($sub): ?><p><?php echo esc_html($sub); ?></p><?php endif; ?>
    <div style="display:flex;gap:.6rem;justify-content:center;flex-wrap:wrap">
      <?php if($cta1_label && $cta1_link): ?><a class="btn btn-accent-green" href="<?php echo esc_url(home_url($cta1_link)); ?>"><?php echo esc_html($cta1_label); ?></a><?php endif; ?>
      <?php if($cta2_label && $cta2_link): ?><a class="btn btn-outline" href="<?php echo esc_url(home_url($cta2_link)); ?>"><?php echo esc_html($cta2_label); ?></a><?php endif; ?>
    </div>
  </div>
  <button class="scroll-down" aria-label="اسکرول به پایین" data-scroll-next></button>
</section>

<?php
    // BAND
    elseif($type==='band'):
?>
<section class="section-wrap apple-section builder-band <?php echo esc_attr($style); ?> parallax-wrap snap">
  <div class="container">
    <div class="apple-module <?php echo esc_attr($style); ?>" data-aos="fade-up">
      <div class="module-copy" data-reveal>
        <p class="eyebrow"><?php echo esc_html(get_post_meta($id,'_ztm_tagline',true) ?: __('ویژگی برجسته','ztm')); ?></p>
        <h2 class="band-title"><?php echo esc_html($title); ?></h2>
        <?php if($sub): ?><p class="band-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
        <div class="module-cta">
          <?php if($cta1_label && $cta1_link): ?><a class="btn btn-accent-blue" href="<?php echo esc_url(home_url($cta1_link)); ?>"><?php echo esc_html($cta1_label); ?></a><?php endif; ?>
          <?php if($cta2_label && $cta2_link): ?><a class="btn btn-outline" href="<?php echo esc_url(home_url($cta2_link)); ?>"><?php echo esc_html($cta2_label); ?></a><?php endif; ?>
        </div>
      </div>
      <?php if($media): ?>
        <div class="module-media">
          <div class="glass"></div>
          <?php if(preg_match('/\.(mp4|webm)$/i',$media)): ?>
            <video src="<?php echo esc_url($media); ?>" autoplay muted loop playsinline></video>
          <?php else: ?>
            <img src="<?php echo esc_url($media); ?>" alt="<?php echo esc_attr($title); ?>">
          <?php endif; ?>
        </div>
      <?php else: ?>
        <div class="module-media module-placeholder">
          <div class="glass"></div>
          <span><?php _e('تصویر یا ویدیو را اضافه کنید','ztm'); ?></span>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php
    // EXPLORE / SERVICES tiles
    elseif($type==='explore'):
?>
<section class="section-wrap apple-section <?php echo esc_attr($style); ?>">
  <div class="container section-head">
    <div>
      <h2 class="section-title" data-reveal><?php echo esc_html($title); ?></h2>
      <?php if($sub): ?><p class="section-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
    </div>
    <div class="section-meta">
      <?php if($cta1_label && $cta1_link): ?><a class="link-inline" href="<?php echo esc_url(home_url($cta1_link)); ?>"><?php echo esc_html($cta1_label); ?></a><?php endif; ?>
      <?php if($cta2_label && $cta2_link): ?><a class="link-inline" href="<?php echo esc_url(home_url($cta2_link)); ?>"><?php echo esc_html($cta2_label); ?></a><?php endif; ?>
    </div>
  </div>

  <div class="container apple-panels" role="list">
    <article class="apple-panel <?php echo $style==='dark'?'dark':'light'; ?>" role="listitem" data-aos="fade-up" <?php if($media): ?>style="--panel-image:url('<?php echo esc_url($media); ?>')"<?php endif; ?>>
      <div class="panel-inner">
        <p class="eyebrow"><?php echo esc_html(get_post_meta($id,'_ztm_tagline',true) ?: __('کشف بیشتر','ztm')); ?></p>
        <h3><?php echo esc_html($title); ?></h3>
        <?php if($sub): ?><p class="panel-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
        <div class="tile-cta">
          <?php if($cta1_label && $cta1_link): ?><a class="btn btn-accent-blue" href="<?php echo esc_url(home_url($cta1_link)); ?>"><?php echo esc_html($cta1_label); ?></a><?php endif; ?>
          <?php if($cta2_label && $cta2_link): ?><a class="btn btn-outline" href="<?php echo esc_url(home_url($cta2_link)); ?>"><?php echo esc_html($cta2_label); ?></a><?php endif; ?>
        </div>
      </div>
    </article>
  </div>
</section>

<?php
    // PROJECTS
    elseif($type==='projects'):
?>
<section class="section-wrap" style="background:var(--bg-soft)">
  <div class="container section-head">
    <div>
      <h2 class="section-title" data-reveal><?php echo esc_html($title); ?></h2>
      <?php if($sub): ?><p class="section-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
    </div>
    <a class="btn btn-outline" href="<?php echo esc_url(get_post_type_archive_link('ztm_project')); ?>">همه پروژه‌ها</a>
  </div>
  <div class="container grid grid-3">
    <?php $q=new WP_Query(['post_type'=>'ztm_project','posts_per_page'=>3]);
    if($q->have_posts()): while($q->have_posts()): $q->the_post(); ?>
      <article class="card" data-aos="fade-up">
        <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
        <h3 style="margin-top:1rem"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(),16); ?></p>
      </article>
    <?php endwhile; wp_reset_postdata(); else: ?>
      <p class="small">هنوز پروژه‌ای ثبت نشده است.</p>
    <?php endif; ?>
  </div>
</section>

<?php
    // PRODUCTS
    elseif($type==='products'):
?>
<section class="section-wrap">
  <div class="container section-head">
    <div>
      <h2 class="section-title" data-reveal><?php echo esc_html($title); ?></h2>
      <?php if($sub): ?><p class="section-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
    </div>
    <a class="btn btn-outline" href="<?php echo esc_url(get_post_type_archive_link('ztm_product')); ?>">مشاهده کاتالوگ</a>
  </div>
  <div class="container grid grid-3">
    <?php $q=new WP_Query(['post_type'=>'ztm_product','posts_per_page'=>3]);
    if($q->have_posts()): while($q->have_posts()): $q->the_post(); ?>
      <article class="card" data-aos="fade-up">
        <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
        <h3 style="margin-top:1rem"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(),16); ?></p>
      </article>
    <?php endwhile; wp_reset_postdata(); else: ?>
      <p class="small">هنوز محصولی ثبت نشده است.</p>
    <?php endif; ?>
  </div>
</section>

<?php
    // CONTACT
    elseif($type==='contact'):
?>
<section class="section-wrap" style="background:var(--bg-soft)">
  <div class="container split">
    <div data-aos="fade-up">
      <h2 class="section-title" data-reveal><?php echo esc_html($title); ?></h2>
      <?php if($sub): ?><p class="section-sub"><?php echo esc_html($sub); ?></p><?php endif; ?>
      <ul class="small">
        <?php if($p=ztm_get_option('phone')): ?><li><?php echo esc_html($p); ?></li><?php endif; ?>
        <?php if($e=ztm_get_option('email')): ?><li><?php echo esc_html($e); ?></li><?php endif; ?>
        <?php if($a=ztm_get_option('address')): ?><li><?php echo nl2br(esc_html($a)); ?></li><?php endif; ?>
      </ul>
    </div>
    <div data-aos="fade-up" data-aos-delay="80">
      <?php if(isset($_GET['lead']) && $_GET['lead']=='success'){ echo '<p class="small" style="color:var(--green);font-weight:700">درخواست شما با موفقیت ثبت شد ✅</p>'; } ?>
      <?php echo do_shortcode('[ztm_lead_form]'); ?>
    </div>
  </div>
</section>

<?php
    endif; // type
  endwhile; wp_reset_postdata();
else:
  // fallback old static template if no sections defined
  get_template_part('front-page','static');
endif;
?>

<?php get_footer(); ?>
