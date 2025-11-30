<?php get_header(); ?>
<section class="archive-hero"><div class="container section-head">
  <div><h1 class="section-title"><?php post_type_archive_title(); ?></h1>
  <p class="section-sub">دسته‌بندی را انتخاب و محصولات را بررسی کنید.</p></div>
</div></section>

<section class="section">
<div class="container" style="margin-bottom:1rem">
<?php $terms=get_terms(['taxonomy'=>'ztm_product_cat','hide_empty'=>true]);
if($terms&&!is_wp_error($terms)):
 echo '<div style="display:flex;gap:.5rem;flex-wrap:wrap">';
 echo '<a class="btn btn-outline" href="'.esc_url(get_post_type_archive_link('ztm_product')).'">همه</a>';
 foreach($terms as $t) echo '<a class="btn btn-outline" href="'.esc_url(get_term_link($t)).'">'.esc_html($t->name).'</a>';
 echo '</div>';
endif; ?>
</div>

<div class="container grid grid-3">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article class="card" data-aos="fade-up">
<?php if(has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
<h3 style="margin-top:1rem"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p><?php echo wp_trim_words(get_the_excerpt(),18); ?></p>
</article>
<?php endwhile; else: ?><p class="small">محصولی یافت نشد.</p><?php endif; ?>
</div>

<div class="container pagination"><?php the_posts_pagination(['prev_text'=>'قبلی','next_text'=>'بعدی']); ?></div>
</section>
<?php get_footer(); ?>
