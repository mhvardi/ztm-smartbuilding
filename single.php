<?php get_header(); ?>
<section class="section"><div class="container split">
<article>
  <h1 class="section-title"><?php the_title(); ?></h1>
  <div class="post-meta"><?php echo get_the_date(); ?> · <?php the_category('، '); ?></div>
  <?php if(has_post_thumbnail()): ?><div style="margin:1.2rem 0;border-radius:18px;overflow:hidden"><?php the_post_thumbnail('large'); ?></div><?php endif; ?>
  <?php the_content(); ?>
</article>
<aside><?php get_sidebar(); ?></aside>
</div></section>
<?php get_footer(); ?>
