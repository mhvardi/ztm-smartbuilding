</main>
<footer class="footer">
  <div class="container footer-grid">
    <div>
      <h3><?php echo esc_html(ztm_get_option('company_name','زرین تجارت مبنا')); ?></h3>
      <p class="small"><?php echo wp_kses_post(ztm_get_option('company_intro','')); ?></p>
      <div class="small">
        <?php if($p=ztm_get_option('phone')): ?><div><?php echo esc_html($p); ?></div><?php endif; ?>
        <?php if($e=ztm_get_option('email')): ?><div><?php echo esc_html($e); ?></div><?php endif; ?>
        <?php if($a=ztm_get_option('address')): ?><div><?php echo nl2br(esc_html($a)); ?></div><?php endif; ?>
      </div>
    </div>
    <div><h4>لینک‌های سریع</h4><?php wp_nav_menu(['theme_location'=>'footer','container'=>false]); ?></div>
    <div><h4>شبکه‌های اجتماعی</h4><p class="small">به زودی…</p></div>
  </div>
  <div class="container small" style="margin-top:2rem">© <?php echo date('Y'); ?> <?php echo esc_html(ztm_get_option('company_name','زرین تجارت مبنا')); ?></div>
</footer>
<?php wp_footer(); ?>
</body></html>
