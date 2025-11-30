<?php
function ztm_settings(){
  $opt = get_option('ztm_settings', []);
  return is_array($opt) ? $opt : [];
}
function ztm_get_option($key, $default=null){
  $opt = ztm_settings();
  if(array_key_exists($key, $opt) && $opt[$key] !== '') return $opt[$key];
  // fallback to customizer if exists
  $map = [
    'primary_green'=>'ztm_primary_green',
    'primary_blue'=>'ztm_primary_blue',
    'neutral_gray'=>'ztm_neutral_gray',
    'company_name'=>'ztm_company_name',
    'company_intro'=>'ztm_company_short_intro',
    'logo_url'=>'ztm_logo_url',
    'phone'=>'ztm_contact_phone',
    'email'=>'ztm_contact_email',
    'address'=>'ztm_contact_address',
  ];
  if(isset($map[$key])) return get_theme_mod($map[$key], $default);
  return $default;
}
function ztm_section_enabled($key, $default=true){
  return (bool)ztm_get_option($key, $default);
}
