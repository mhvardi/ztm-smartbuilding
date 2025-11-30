<?php
/**
 * Home Sections Builder (سبک و مشابه المنتور برای صفحه اصلی)
 * CPT: ztm_section
 * مرتب‌سازی با menu_order (Drag & Drop)
 */

add_action('init', function(){
  register_post_type('ztm_section', [
    'labels' => [
      'name' => 'سکشن‌های صفحه اصلی',
      'singular_name' => 'سکشن',
      'menu_name' => 'سکشن‌های صفحه اصلی',
      'add_new_item' => 'افزودن سکشن',
      'edit_item' => 'ویرایش سکشن',
      'not_found' => 'سکشنی یافت نشد',
    ],
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => 'ztm-theme-settings',
    'supports' => ['title','page-attributes'],
    'menu_icon' => 'dashicons-screenoptions',
  ]);
});

add_action('add_meta_boxes', function(){
  add_meta_box('ztm_section_meta','تنظیمات سکشن','ztm_section_meta_cb','ztm_section','normal','high');
  add_meta_box('ztm_section_widgets','ویجت‌های سفارشی (ویرایشگر صفحه)','ztm_section_widgets_cb','ztm_section','normal','default');
});

function ztm_section_meta_cb($post){
  $type  = get_post_meta($post->ID,'_ztm_type',true) ?: 'band';
  $style = get_post_meta($post->ID,'_ztm_style',true) ?: 'light';
  $title = get_post_meta($post->ID,'_ztm_title',true);
  $sub   = get_post_meta($post->ID,'_ztm_sub',true);
  $media = get_post_meta($post->ID,'_ztm_media',true);
  $cta1_label = get_post_meta($post->ID,'_ztm_cta1_label',true);
  $cta1_link  = get_post_meta($post->ID,'_ztm_cta1_link',true);
  $cta2_label = get_post_meta($post->ID,'_ztm_cta2_label',true);
  $cta2_link  = get_post_meta($post->ID,'_ztm_cta2_link',true);
  $enabled = get_post_meta($post->ID,'_ztm_enabled',true);
  wp_nonce_field('ztm_section_save','ztm_section_nonce');
  ?>
  <p>
    <label>فعال باشد؟</label>
    <input type="checkbox" name="ztm_enabled" value="1" <?php checked($enabled,1); ?>>
  </p>
  <p>
    <label>نوع سکشن</label><br>
    <select name="ztm_type">
      <option value="hero" <?php selected($type,'hero'); ?>>هرو (لوگو موشن)</option>
      <option value="band" <?php selected($type,'band'); ?>>Band تمام‌عرض</option>
      <option value="explore" <?php selected($type,'explore'); ?>>کارت‌های Explore/Services</option>
      <option value="projects" <?php selected($type,'projects'); ?>>پروژه‌های منتخب</option>
      <option value="products" <?php selected($type,'products'); ?>>محصولات منتخب</option>
      <option value="contact" <?php selected($type,'contact'); ?>>درخواست مشاوره</option>
    </select>
  </p>
  <p>
    <label>استایل</label><br>
    <select name="ztm_style">
      <option value="light" <?php selected($style,'light'); ?>>روشن</option>
      <option value="dark" <?php selected($style,'dark'); ?>>تیره</option>
    </select>
  </p>
  <p><label>تیتر</label><br><input style="width:100%" name="ztm_title" value="<?php echo esc_attr($title); ?>"></p>
  <p><label>توضیح کوتاه</label><br><textarea style="width:100%" rows="3" name="ztm_sub"><?php echo esc_textarea($sub); ?></textarea></p>
  <p><label>آدرس تصویر/PNG/ویدئو (URL)</label><br><input style="width:100%" name="ztm_media" value="<?php echo esc_attr($media); ?>"></p>
  <hr>
  <p><label>دکمه ۱ - متن</label><br><input style="width:100%" name="ztm_cta1_label" value="<?php echo esc_attr($cta1_label); ?>"></p>
  <p><label>دکمه ۱ - لینک</label><br><input style="width:100%" name="ztm_cta1_link" value="<?php echo esc_attr($cta1_link); ?>"></p>
  <p><label>دکمه ۲ - متن</label><br><input style="width:100%" name="ztm_cta2_label" value="<?php echo esc_attr($cta2_label); ?>"></p>
  <p><label>دکمه ۲ - لینک</label><br><input style="width:100%" name="ztm_cta2_link" value="<?php echo esc_attr($cta2_link); ?>"></p>
  <p class="small">ترتیب نمایش را در لیست «سکشن‌های صفحه اصلی» با Drag & Drop (ستون ترتیب) تغییر دهید.</p>
  <?php
}

function ztm_section_widgets_cb($post){
  $widgets = get_post_meta($post->ID,'_ztm_widgets',true);
  if(!is_array($widgets)) $widgets = [];
  ?>
  <p class="description">المان‌های اختصاصی هر سکشن را مانند المنتور اضافه کنید و برای هر ویجت، استایل جداگانه بگذارید.</p>
  <div id="ztm-widgets" class="ztm-widgets-builder">
    <?php if(empty($widgets)) $widgets[] = ['type'=>'text']; ?>
    <?php foreach($widgets as $i=>$w): ?>
      <div class="ztm-widget-card">
        <div class="ztm-widget-card__head">
          <strong>ویجت #<?php echo $i+1; ?></strong>
          <div class="ztm-widget-card__actions">
            <button type="button" class="button move-up" aria-label="بالا">↑</button>
            <button type="button" class="button move-down" aria-label="پایین">↓</button>
            <button type="button" class="button remove" aria-label="حذف">✕</button>
          </div>
        </div>
        <div class="ztm-widget-grid">
          <p>
            <label>نوع المان</label><br>
            <select name="ztm_widgets[<?php echo $i; ?>][type]">
              <?php foreach(['text'=>'متن','media'=>'تصویر/ویدئو','cta'=>'دکمه','badge'=>'برچسب','html'=>'HTML خام'] as $k=>$label): ?>
                <option value="<?php echo esc_attr($k); ?>" <?php selected($w['type'] ?? '',$k); ?>><?php echo esc_html($label); ?></option>
              <?php endforeach; ?>
            </select>
          </p>
          <p><label>تیتر</label><br><input name="ztm_widgets[<?php echo $i; ?>][title]" value="<?php echo esc_attr($w['title'] ?? ''); ?>" class="widefat"></p>
          <p><label>متن/توضیح</label><br><textarea name="ztm_widgets[<?php echo $i; ?>][text]" rows="3" class="widefat"><?php echo esc_textarea($w['text'] ?? ''); ?></textarea></p>
          <p><label>لینک مدیا یا آیکون (URL)</label><br><input name="ztm_widgets[<?php echo $i; ?>][media]" value="<?php echo esc_attr($w['media'] ?? ''); ?>" class="widefat"></p>
          <p><label>متن دکمه</label><br><input name="ztm_widgets[<?php echo $i; ?>][cta_label]" value="<?php echo esc_attr($w['cta_label'] ?? ''); ?>" class="widefat"></p>
          <p><label>لینک دکمه</label><br><input name="ztm_widgets[<?php echo $i; ?>][cta_link]" value="<?php echo esc_attr($w['cta_link'] ?? ''); ?>" class="widefat"></p>
          <p><label>کلاس سفارشی</label><br><input name="ztm_widgets[<?php echo $i; ?>][class]" value="<?php echo esc_attr($w['class'] ?? ''); ?>" class="widefat"></p>
          <p><label>رنگ پس‌زمینه ویجت</label><br><input type="color" name="ztm_widgets[<?php echo $i; ?>][bg]" value="<?php echo esc_attr($w['bg'] ?? '#ffffff'); ?>"></p>
          <p><label>رنگ متن ویجت</label><br><input type="color" name="ztm_widgets[<?php echo $i; ?>][text_color]" value="<?php echo esc_attr($w['text_color'] ?? '#0b0c0f'); ?>"></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <p><button type="button" class="button button-primary" id="add-ztm-widget">افزودن ویجت جدید</button></p>
  <style>
    .ztm-widgets-builder{display:grid;gap:12px}
    .ztm-widget-card{border:1px solid #dfe3e6;border-radius:10px;padding:12px;background:#fff}
    .ztm-widget-card__head{display:flex;align-items:center;justify-content:space-between;margin-bottom:6px}
    .ztm-widget-card__actions{display:flex;gap:4px}
    .ztm-widget-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:10px}
  </style>
  <script>
    (function(){
      const container = document.getElementById('ztm-widgets');
      const addBtn = document.getElementById('add-ztm-widget');
      const template = (index)=>`
      <div class="ztm-widget-card">
        <div class="ztm-widget-card__head">
          <strong>ویجت #${index+1}</strong>
          <div class="ztm-widget-card__actions">
            <button type="button" class="button move-up">↑</button>
            <button type="button" class="button move-down">↓</button>
            <button type="button" class="button remove">✕</button>
          </div>
        </div>
        <div class="ztm-widget-grid">
          <p><label>نوع المان</label><br><select name="ztm_widgets[${index}][type]">
            <option value="text">متن</option>
            <option value="media">تصویر/ویدئو</option>
            <option value="cta">دکمه</option>
            <option value="badge">برچسب</option>
            <option value="html">HTML خام</option>
          </select></p>
          <p><label>تیتر</label><br><input name="ztm_widgets[${index}][title]" class="widefat"></p>
          <p><label>متن/توضیح</label><br><textarea name="ztm_widgets[${index}][text]" rows="3" class="widefat"></textarea></p>
          <p><label>لینک مدیا یا آیکون (URL)</label><br><input name="ztm_widgets[${index}][media]" class="widefat"></p>
          <p><label>متن دکمه</label><br><input name="ztm_widgets[${index}][cta_label]" class="widefat"></p>
          <p><label>لینک دکمه</label><br><input name="ztm_widgets[${index}][cta_link]" class="widefat"></p>
          <p><label>کلاس سفارشی</label><br><input name="ztm_widgets[${index}][class]" class="widefat"></p>
          <p><label>رنگ پس‌زمینه ویجت</label><br><input type="color" name="ztm_widgets[${index}][bg]" value="#ffffff"></p>
          <p><label>رنگ متن ویجت</label><br><input type="color" name="ztm_widgets[${index}][text_color]" value="#0b0c0f"></p>
        </div>
      </div>`;

      function refreshIndexes(){
        container.querySelectorAll('.ztm-widget-card').forEach((card, idx)=>{
          card.querySelector('strong').textContent = `ویجت #${idx+1}`;
          card.querySelectorAll('input, textarea, select').forEach(el=>{
            const name = el.getAttribute('name');
            if(!name) return;
            const newName = name.replace(/ztm_widgets\[\d+\]/, `ztm_widgets[${idx}]`);
            el.setAttribute('name', newName);
          });
        });
      }

      addBtn.addEventListener('click', ()=>{
        container.insertAdjacentHTML('beforeend', template(container.children.length));
      });

      container.addEventListener('click', (e)=>{
        const card = e.target.closest('.ztm-widget-card');
        if(!card) return;
        if(e.target.classList.contains('remove')){
          card.remove();
          refreshIndexes();
        }
        if(e.target.classList.contains('move-up')){
          const prev = card.previousElementSibling;
          if(prev){ card.parentNode.insertBefore(card, prev); refreshIndexes(); }
        }
        if(e.target.classList.contains('move-down')){
          const next = card.nextElementSibling;
          if(next){ card.parentNode.insertBefore(next, card); refreshIndexes(); }
        }
      });
    })();
  </script>
  <?php
}

add_action('save_post_ztm_section', function($post_id){
  if(!isset($_POST['ztm_section_nonce']) || !wp_verify_nonce($_POST['ztm_section_nonce'],'ztm_section_save')) return;
  update_post_meta($post_id,'_ztm_enabled', isset($_POST['ztm_enabled'])?1:0);
  foreach([
    'ztm_type'=>'_ztm_type',
    'ztm_style'=>'_ztm_style',
    'ztm_title'=>'_ztm_title',
    'ztm_sub'=>'_ztm_sub',
    'ztm_media'=>'_ztm_media',
    'ztm_cta1_label'=>'_ztm_cta1_label',
    'ztm_cta1_link'=>'_ztm_cta1_link',
    'ztm_cta2_label'=>'_ztm_cta2_label',
    'ztm_cta2_link'=>'_ztm_cta2_link',
  ] as $k=>$meta){
    if(isset($_POST[$k])) update_post_meta($post_id,$meta, sanitize_text_field($_POST[$k]));
  }
  $widgets = $_POST['ztm_widgets'] ?? [];
  $clean_widgets = [];
  if(is_array($widgets)){
    foreach($widgets as $w){
      if(empty($w['title']) && empty($w['text']) && empty($w['media']) && empty($w['cta_label'])) continue;
      $clean_widgets[] = [
        'type' => sanitize_key($w['type'] ?? 'text'),
        'title' => sanitize_text_field($w['title'] ?? ''),
        'text' => wp_kses_post($w['text'] ?? ''),
        'media' => esc_url_raw($w['media'] ?? ''),
        'cta_label' => sanitize_text_field($w['cta_label'] ?? ''),
        'cta_link' => sanitize_text_field($w['cta_link'] ?? ''),
        'class' => sanitize_text_field($w['class'] ?? ''),
        'bg' => sanitize_hex_color($w['bg'] ?? ''),
        'text_color' => sanitize_hex_color($w['text_color'] ?? ''),
      ];
    }
  }
  update_post_meta($post_id,'_ztm_widgets',$clean_widgets);
});
