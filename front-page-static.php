<?php get_header(); ?>

<?php if(ztm_section_enabled('hero_enable', true)): 
  $hero_media = ztm_get_option('hero_media','');
?>
<section class="hero-full parallax-wrap">
  <div class="hero-bg">
    <?php if($hero_media && preg_match('/\.(mp4|webm)$/i',$hero_media)): ?>
      <video src="<?php echo esc_url($hero_media); ?>" autoplay muted loop playsinline></video>
    <?php elseif($hero_media): ?>
      <img src="<?php echo esc_url($hero_media); ?>" alt="<?php echo esc_attr(ztm_get_option('hero_title')); ?>">
    <?php else: ?>
      <img src="https://images.unsplash.com/photo-1558002038-1055907df827?q=80&w=2000&auto=format&fit=crop" alt="هوشمندسازی ساختمان">
    <?php endif; ?>
  </div>
  <div class="hero-overlay"></div>

  <!-- لایه‌های پارالاکس نرم -->
  <div class="parallax-layer" data-parallax="0.12" style="background-image:url('https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2000&auto=format&fit=crop')"></div>

  <div class="container hero-content" data-aos="fade-up">
    <div class="hero-badges">
      <span class="badge">هوشمندسازی ساختمان</span>
      <span class="badge">VoIP</span>
      <span class="badge">امنیت و نظارت</span>
      <span class="badge">UPS</span>
    </div>

    <h1><?php echo esc_html(ztm_get_option('hero_title','هوشمندسازی ساختمان، ساده و لوکس')); ?></h1>
    <p><?php echo esc_html(ztm_get_option('hero_sub','راهکارهای هوشمند برای ساختمان‌های مدرن و آینده‌نگر.')); ?></p>
    <div style="display:flex;gap:.7rem;justify-content:center;flex-wrap:wrap">
      <a class="btn btn-accent-green" href="<?php echo esc_url(home_url(ztm_get_option('hero_cta_link','/contact'))); ?>">
        <?php echo esc_html(ztm_get_option('hero_cta_label','درخواست مشاوره')); ?>
      </a>
      <a class="btn btn-outline" href="<?php echo esc_url(home_url('/services')); ?>">مشاهده خدمات</a>
    </div>
  </div>
</section>
<?php endif; ?>

<section class="section">
  <div class="container section-head">
    <div>
      <h2 class="section-title">خدمات اصلی</h2>
      <p class="section-sub">راهکارهای هوشمند از مشاوره تا اجرا.</p>
    </div>
  </div>
  <div class="container grid grid-3">
    <div class="card" data-aos="fade-up">
      <h3>هوشمندسازی ساختمان</h3>
      <p>پیاده‌سازی BMS، روشنایی، HVAC، کنترل دسترسی و سناریوهای هوشمند.</p>
    </div>
    <div class="card" data-aos="fade-up" data-aos-delay="50">
      <h3>تلفن ویپ (VoIP)</h3>
      <p>راهکارهای مرکز تماس، سانترال IP و تلفن سازمانی با کیفیت بالا.</p>
    </div>
    <div class="card" data-aos="fade-up" data-aos-delay="100">
      <h3>سیستم‌های حفاظتی و نظارتی</h3>
      <p>دوربین مداربسته، دزدگیر، قفل هوشمند و مانیتورینگ امنیتی.</p>
    </div>
  </div>
</section>

<?php
// Bands تمام‌صفحه مشابه صفحات اپل
$default_band_media = [
  1 => 'https://videos.pexels.com/video-files/856072/856072-hd_1920_1080_25fps.mp4',
  2 => 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?q=80&w=2000&auto=format&fit=crop',
  3 => 'https://images.unsplash.com/photo-1565043666747-69f6646db940?q=80&w=2000&auto=format&fit=crop',
];

for($i=1;$i<=3;$i++):
  if(!ztm_section_enabled("band{$i}_enable", false)) continue;
  $style = ztm_get_option("band{$i}_style", $i==1?'dark':'light');
  $title = ztm_get_option("band{$i}_title", $i==1?'هوشمندسازی که حس آینده می‌دهد':'راهکار ویژه');
  $sub   = ztm_get_option("band{$i}_sub", 'توضیح کوتاه برای این سکشن.');
  $media = ztm_get_option("band{$i}_media", $default_band_media[$i]);
  $cta_label = ztm_get_option("band{$i}_cta_label",'بیشتر بدانید');
  $cta_link  = ztm_get_option("band{$i}_cta_link",'/services');
?>
<section class="band-full <?php echo esc_attr($style); ?> parallax-wrap">
  <?php if($style=='dark'): ?>
    <div class="parallax-layer" data-parallax="0.08" style="background-image:url('https://images.unsplash.com/photo-1545239351-1141bd82e8a6?q=80&w=2000&auto=format&fit=crop')"></div>
  <?php endif; ?>
  <div class="container" data-aos="fade-up">
    <h2 class="band-title"><?php echo esc_html($title); ?></h2>
    <p class="band-sub"><?php echo esc_html($sub); ?></p>
    <p><a class="btn btn-accent-blue" href="<?php echo esc_url(home_url($cta_link)); ?>"><?php echo esc_html($cta_label); ?></a></p>

    <?php if($media): ?>
    <div class="band-media" data-aos="zoom-out" data-aos-delay="140">
      <?php if(preg_match('/\.(mp4|webm)$/i',$media)): ?>
        <video src="<?php echo esc_url($media); ?>" autoplay muted loop playsinline></video>
      <?php else: ?>
        <img src="<?php echo esc_url($media); ?>" alt="<?php echo esc_attr($title); ?>">
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php endfor; ?>

<?php
// Explore grid مثل اپل
$default_explore_media = [
  1 => 'https://images.unsplash.com/photo-1558002038-1055907df827?q=80&w=2000&auto=format&fit=crop',
  2 => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=2000&auto=format&fit=crop',
  3 => 'https://images.unsplash.com/photo-1581090700227-1e37b190418e?q=80&w=2000&auto=format&fit=crop',
  4 => 'https://images.unsplash.com/photo-1558998708-ed5f65d6f4ad?q=80&w=2000&auto=format&fit=crop',
];
?>

<section class="explore">
  <div class="container section-head">
    <div>
      <h2 class="section-title" data-reveal>کاوش راهکارها</h2>
      <p class="section-sub">انتخاب کنید و بیشتر ببینید.</p>
    </div>
  </div>

  <div class="container apple-grid">
    <?php for($i=1;$i<=4;$i++):
      if(!ztm_section_enabled("explore{$i}_enable", true)) continue;
      $estyle = ztm_get_option("explore{$i}_style", $i%2==1?'dark':'light');
      $etitle = ztm_get_option("explore{$i}_title", $i==1?'هوشمندسازی ویلا':($i==2?'مرکز تماس سازمانی':($i==3?'امنیت هوشمند':'UPS صنعتی')));
      $esub   = ztm_get_option("explore{$i}_sub", 'توضیح کوتاه درباره این راهکار.');
      $emedia = ztm_get_option("explore{$i}_media", '');
      $ecta_label = ztm_get_option("explore{$i}_cta_label",'مشاهده');
      $ecta_link  = ztm_get_option("explore{$i}_cta_link",'/services');
    ?>
      <article class="apple-tile <?php echo $estyle=='dark'?'dark':'light'; ?>" data-aos="fade-up">
        <div class="tile-content">
          <h3><?php echo esc_html($etitle); ?></h3>
          <p><?php echo esc_html($esub); ?></p>
          <div class="tile-cta">
            <a class="btn btn-accent-blue" href="<?php echo esc_url(home_url($ecta_link)); ?>"><?php echo esc_html($ecta_label); ?></a>
            <a class="btn btn-outline" href="<?php echo esc_url(home_url('/contact')); ?>">تماس</a>
          </div>
        </div>
        <div class="tile-media">
          <?php if($emedia): ?>
            <img src="<?php echo esc_url($emedia); ?>" alt="<?php echo esc_attr($etitle); ?>">
          <?php else: ?>
            <img src="https://pngimg.com/uploads/smart_home/smart_home_PNG12.png" alt="">
          <?php endif; ?>
        </div>
      </article>
    <?php endfor; ?>
  </div>
</section>
<?php if(ztm_section_enabled('home_projects_enable', true)): ?>
<section class="section" style="background:var(--bg-soft)">
  <div class="container section-head">
    <div>
      <h2 class="section-title">پروژه‌های منتخب</h2>
      <p class="section-sub">نمونه‌ای از پروژه‌های اجرا شده توسط ما.</p>
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
<?php endif; ?>

<?php if(ztm_section_enabled('home_products_enable', true)): ?>
<section class="section">
  <div class="container section-head">
    <div>
      <h2 class="section-title">محصولات منتخب</h2>
      <p class="section-sub">کاتالوگ تجهیزات و راهکارهای پیشنهادی.</p>
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
<?php endif; ?>

<?php if(ztm_section_enabled('home_contact_enable', true)): ?>
<section class="section" style="background:var(--bg-soft)">
  <div class="container split">
    <div data-aos="fade-up">
      <h2 class="section-title">درخواست مشاوره</h2>
      <p class="section-sub">برای دریافت مشاوره رایگان، با ما در تماس باشید.</p>
      <ul class="small">
        <?php if($p=ztm_get_option('phone')): ?><li><?php echo esc_html($p); ?></li><?php endif; ?>
        <?php if($e=ztm_get_option('email')): ?><li><?php echo esc_html($e); ?></li><?php endif; ?>
        <?php if($a=ztm_get_option('address')): ?><li><?php echo nl2br(esc_html($a)); ?></li><?php endif; ?>
      </ul>
    </div>
    <div class="card" data-aos="fade-up" data-aos-delay="80">
      <?php echo do_shortcode('[contact-form-7 id="1" title="فرم تماس"]'); ?>
      <p class="small">اگر CF7 ندارید، شورتکد را تغییر دهید.</p>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
