<?php get_header(); ?>
<section class="archive-hero"><div class="container">
  <h1 class="section-title"><?php single_term_title(); ?></h1>
  <p class="section-sub"><?php echo term_description(); ?></p>
</div></section>

<section class="section"><div class="container grid grid-3">
<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article class="card" data-aos="fade-up">
<?php if(has_post_thumbnail()): ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
<h3 style="margin-top:1rem"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<p><?php echo wp_trim_words(get_the_excerpt(),18); ?></p>
</article>
<?php endwhile; else: ?><p class="small">محصولی در این دسته موجود نیست.</p><?php endif; ?>
</div></section>
<?php get_footer(); ?>
