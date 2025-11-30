<?php get_header(); ?>
<section class="archive-hero"><div class="container">
  <h1 class="section-title"><?php single_post_title(); ?></h1>
  <?php if(is_home()): ?><p class="section-sub"><?php bloginfo('description'); ?></p><?php endif; ?>
</div></section>

<section class="section">
<div class="container grid grid-3">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article <?php post_class('card post-card'); ?> data-aos="fade-up">
  <?php if(has_post_thumbnail()): ?><a class="thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
  <div class="post-meta"><?php echo get_the_date(); ?></div>
  <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
  <p><?php echo wp_trim_words(get_the_excerpt(),18); ?></p>
</article>
<?php endwhile; else: ?><p>موردی یافت نشد.</p><?php endif; ?>
</div>
<div class="container pagination"><?php the_posts_pagination(['prev_text'=>'قبلی','next_text'=>'بعدی']); ?></div>
</section>
<?php get_footer(); ?>
