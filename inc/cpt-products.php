<?php
add_action('init', function(){
  register_post_type('ztm_product', [
    'labels' => [
      'name'=>'محصولات','singular_name'=>'محصول','add_new'=>'افزودن محصول',
      'add_new_item'=>'افزودن محصول جدید','edit_item'=>'ویرایش محصول','new_item'=>'محصول جدید',
      'view_item'=>'مشاهده محصول','search_items'=>'جستجوی محصولات','not_found'=>'محصولی یافت نشد',
      'all_items'=>'همه محصولات','menu_name'=>'محصولات',
    ],
    'public'=>true,'has_archive'=>true,'menu_icon'=>'dashicons-products',
    'rewrite'=>['slug'=>'products'],
    'supports'=>['title','editor','thumbnail','excerpt','revisions'],
    'show_in_rest'=>true,
  ]);

  register_taxonomy('ztm_product_cat','ztm_product',[
    'labels'=>[
      'name'=>'دسته‌بندی محصولات','singular_name'=>'دسته محصول','menu_name'=>'دسته‌بندی محصولات',
      'add_new_item'=>'افزودن دسته جدید','edit_item'=>'ویرایش دسته','all_items'=>'همه دسته‌ها'
    ],
    'hierarchical'=>true,'rewrite'=>['slug'=>'product-category'],'show_in_rest'=>true,
  ]);
});
