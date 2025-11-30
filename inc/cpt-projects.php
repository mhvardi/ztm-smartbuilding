<?php
add_action('init', function(){
  register_post_type('ztm_project', [
    'labels' => [
      'name'=>'پروژه‌ها','singular_name'=>'پروژه','add_new'=>'افزودن پروژه',
      'add_new_item'=>'افزودن پروژه جدید','edit_item'=>'ویرایش پروژه','new_item'=>'پروژه جدید',
      'view_item'=>'مشاهده پروژه','search_items'=>'جستجوی پروژه‌ها','not_found'=>'پروژه‌ای یافت نشد',
      'all_items'=>'همه پروژه‌ها','menu_name'=>'پروژه‌ها',
    ],
    'public'=>true,'has_archive'=>true,'menu_icon'=>'dashicons-portfolio',
    'rewrite'=>['slug'=>'projects'],
    'supports'=>['title','editor','thumbnail','excerpt','revisions'],
    'show_in_rest'=>true,
  ]);
});
