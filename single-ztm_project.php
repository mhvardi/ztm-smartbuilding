<?php get_header(); the_post(); ?>

<nav class="subnav">
  <div class="container subnav-inner">
    <strong><?php the_title(); ?></strong>
    <div class="subnav-links">
      <a href="#overview">معرفی</a>
      <a href="#details">جزئیات</a>
    </div>
    <a class="btn btn-accent-green" href="<?php echo esc_url(home_url('/contact')); ?>">درخواست اجرا</a>
  </div>
</nav>

<section class="section" id="overview">
  <div class="container split">
    <div data-aos="fade-up">
      <?php if(has_post_thumbnail()): ?>
        <div style="border-radius:26px;overflow:hidden">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>
    </div>

    <article data-aos="fade-up" data-aos-delay="80">
      <h1 class="section-title"><?php the_title(); ?></h1>
      <p class="section-sub"><?php the_excerpt(); ?></p>

      <?php
        $client = get_post_meta(get_the_ID(),'_ztm_client',true);
        $location = get_post_meta(get_the_ID(),'_ztm_location',true);
        $date = get_post_meta(get_the_ID(),'_ztm_execution_date',true);
        $services = get_post_meta(get_the_ID(),'_ztm_services_done',true);
        if(!is_array($services)) $services=[];
      ?>

      <ul class="small">
        <?php if($client): ?><li><strong>کارفرما:</strong> <?php echo esc_html($client); ?></li><?php endif; ?>
        <?php if($location): ?><li><strong>موقعیت:</strong> <?php echo esc_html($location); ?></li><?php endif; ?>
        <?php if($date): ?><li><strong>تاریخ اجرا:</strong> <?php echo esc_html($date); ?></li><?php endif; ?>
      </ul>
    </article>
  </div>
</section>

<section class="section" id="details" style="background:var(--bg-soft)">
  <div class="container" data-aos="fade-up">
    <h2 class="section-title">خدمات انجام شده</h2>
    <?php if($services): ?>
      <div class="card">
        <ul>
          <?php foreach($services as $s): ?><li><?php echo esc_html($s); ?></li><?php endforeach; ?>
        </ul>
      </div>
    <?php else: ?>
      <p class="small">جزئیاتی ثبت نشده است.</p>
    <?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="container" data-aos="fade-up">
    <?php the_content(); ?>
  </div>
</section>

<?php get_footer(); ?>
