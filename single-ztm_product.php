<?php get_header(); the_post(); ?>

<?php
$stock = get_post_meta(get_the_ID(),'_ztm_stock',true);
$dark = has_post_thumbnail() ? 'dark' : '';
?>
<nav class="subnav <?php echo esc_attr($dark); ?>">
  <div class="container subnav-inner">
    <strong><?php the_title(); ?></strong>
    <div class="subnav-links">
      <a href="#overview">معرفی</a>
      <a href="#specs">مشخصات</a>
      <a href="#download">کاتالوگ</a>
    </div>
    <a class="btn btn-accent-green" href="<?php echo esc_url(home_url('/contact')); ?>">خرید/مشاوره</a>
  </div>
</nav>

<section class="section" id="overview">
  <div class="container split">
    <div data-aos="fade-up">
      <?php if(has_post_thumbnail()): ?>
        <div style="border-radius:26px;overflow:hidden;background:#000">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>
    </div>

    <article data-aos="fade-up" data-aos-delay="80">
      <h1 class="section-title"><?php the_title(); ?></h1>
      <p class="section-sub"><?php the_excerpt(); ?></p>

      <?php
        $price = get_post_meta(get_the_ID(),'_ztm_price',true);
        $pdf   = get_post_meta(get_the_ID(),'_ztm_pdf',true);
        $specs = get_post_meta(get_the_ID(),'_ztm_specs',true);
        if(!is_array($specs)) $specs=[];
      ?>

      <?php if($price): ?>
        <p style="font-size:1.5rem;font-weight:900;margin:1rem 0"><?php echo esc_html($price); ?></p>
      <?php endif; ?>

      <?php if($stock): ?>
        <p class="small">وضعیت: <?php echo $stock=='in_stock'?'موجود':($stock=='out_stock'?'ناموجود':($stock=='special'?'ویژه':'')); ?></p>
      <?php endif; ?>
    </article>
  </div>
</section>

<section class="section" id="specs" style="background:var(--bg-soft)">
  <div class="container" data-aos="fade-up">
    <h2 class="section-title">مشخصات فنی</h2>
    <?php if($specs): ?>
    <div class="card">
      <ul>
        <?php foreach($specs as $row): ?>
          <li><strong><?php echo esc_html($row['label'] ?? ''); ?>:</strong> <?php echo esc_html($row['value'] ?? ''); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <?php else: ?>
      <p class="small">مشخصاتی ثبت نشده است.</p>
    <?php endif; ?>
  </div>
</section>

<section class="section" id="download">
  <div class="container" data-aos="fade-up">
    <h2 class="section-title">دانلود کاتالوگ</h2>
    <?php if(!empty($pdf)): ?>
      <a class="btn btn-accent-blue" href="<?php echo esc_url($pdf); ?>" target="_blank" rel="noopener">دانلود PDF</a>
    <?php else: ?>
      <p class="small">کاتالوگ برای این محصول قرار داده نشده است.</p>
    <?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="container" data-aos="fade-up">
    <?php the_content(); ?>
  </div>
</section>

<?php get_footer(); ?>
