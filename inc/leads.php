<?php
/**
 * سیستم ثبت درخواست مشاوره (Lead)
 * - CPT خصوصی
 * - لیست در پیشخوان
 * - ارسال ایمیل به info@smartztm.com
 */

add_action('init', function () {

  register_post_type('ztm_lead', [
    'labels' => [
      'name'          => 'درخواست‌های مشاوره',
      'singular_name' => 'درخواست مشاوره',
      'menu_name'     => 'درخواست‌های مشاوره',
      'add_new_item'  => 'افزودن درخواست',
      'edit_item'     => 'ویرایش درخواست',
      'not_found'     => 'درخواستی یافت نشد',
    ],
    'public'        => false,
    'show_ui'       => true,
    'show_in_menu'  => 'ztm-theme-settings',
    'supports'      => ['title'],
    'capability_type' => 'post',
    'menu_icon'     => 'dashicons-email-alt2',
  ]);

});

add_action('add_meta_boxes', function(){
  add_meta_box('ztm_lead_meta','اطلاعات درخواست','ztm_lead_meta_cb','ztm_lead','normal','high');
});
function ztm_lead_meta_cb($post){
  $name = get_post_meta($post->ID,'_ztm_lead_name',true);
  $mobile = get_post_meta($post->ID,'_ztm_lead_mobile',true);
  $ip = get_post_meta($post->ID,'_ztm_lead_ip',true);
  $time = get_post_meta($post->ID,'_ztm_lead_time',true);
  echo '<p><strong>نام و نام خانوادگی:</strong> '.esc_html($name).'</p>';
  echo '<p><strong>شماره موبایل:</strong> '.esc_html($mobile).'</p>';
  echo '<p class="small"><strong>IP:</strong> '.esc_html($ip).'</p>';
  echo '<p class="small"><strong>زمان:</strong> '.esc_html($time).'</p>';
}

add_shortcode('ztm_lead_form', function(){
  ob_start(); ?>
  <form class="ztm-lead-form card" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
    <input type="hidden" name="action" value="ztm_lead_submit">
    <?php wp_nonce_field('ztm_lead_submit','ztm_lead_nonce'); ?>

    <p>
      <label for="ztm_lead_name">نام و نام خانوادگی</label><br>
      <input class="form-control" id="ztm_lead_name" name="ztm_lead_name" required>
    </p>
    <p>
      <label for="ztm_lead_mobile">شماره موبایل</label><br>
      <input class="form-control" id="ztm_lead_mobile" name="ztm_lead_mobile" inputmode="tel" pattern="^09\d{9}$" placeholder="مثلاً 09123456789" required>
    </p>

    <p><button class="btn btn-accent-green" type="submit">ثبت درخواست مشاوره رایگان</button></p>
    <p class="small">پس از ثبت، کارشناسان ما با شما تماس خواهند گرفت.</p>
  </form>
  <?php return ob_get_clean();
});

add_action('admin_post_nopriv_ztm_lead_submit','ztm_handle_lead_submit');
add_action('admin_post_ztm_lead_submit','ztm_handle_lead_submit');

function ztm_handle_lead_submit(){
  if(!isset($_POST['ztm_lead_nonce']) || !wp_verify_nonce($_POST['ztm_lead_nonce'],'ztm_lead_submit')){
    wp_die('درخواست نامعتبر است.');
  }
  $name = sanitize_text_field($_POST['ztm_lead_name'] ?? '');
  $mobile = sanitize_text_field($_POST['ztm_lead_mobile'] ?? '');
  if(!$name || !$mobile){
    wp_safe_redirect(wp_get_referer() ?: home_url('/')); exit;
  }

  $post_id = wp_insert_post([
    'post_type' => 'ztm_lead',
    'post_status' => 'publish',
    'post_title' => $name . ' - ' . $mobile,
  ]);

  if($post_id){
    update_post_meta($post_id,'_ztm_lead_name',$name);
    update_post_meta($post_id,'_ztm_lead_mobile',$mobile);
    update_post_meta($post_id,'_ztm_lead_ip', $_SERVER['REMOTE_ADDR'] ?? '');
    update_post_meta($post_id,'_ztm_lead_time', wp_date('Y-m-d H:i'));
  }

  $to = 'info@smartztm.com';
  $subject = 'درخواست مشاوره جدید از سایت';
  $message = "یک درخواست مشاوره جدید ثبت شد:\n\nنام: {$name}\nموبایل: {$mobile}\nزمان: ".wp_date('Y-m-d H:i')."\nIP: ".($_SERVER['REMOTE_ADDR'] ?? '');
  wp_mail($to, $subject, $message, ['Content-Type: text/plain; charset=UTF-8']);

  $redirect = add_query_arg('lead','success', wp_get_referer() ?: home_url('/'));
  wp_safe_redirect($redirect);
  exit;
}
