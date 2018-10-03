<?php

define('ROOTPATH', $_SERVER['DOCUMENT_ROOT']);

#-----------------------------------------------------------------#
# INCLUDE BURO PLUGIN CLASSES - Note : need to find a better way
#-----------------------------------------------------------------#
  // include_once(ROOTPATH.'/wp-content/plugins/buro-defaults-wp/includes/classes.php');

#-----------------------------------------------------------------#
# CUSTOM POST TYPES
#-----------------------------------------------------------------#
  require_once('inc/cpt.php');

#-----------------------------------------------------------------#
# CUSTOM FORMS
#-----------------------------------------------------------------#
  require_once('inc/ajax_functions.php');

#-----------------------------------------------------------------#
# TRANSLATIONS
#-----------------------------------------------------------------#
  require_once('inc/languages.php');

#-----------------------------------------------------------------#
# GENERAL OPTIONS PAGE
#-----------------------------------------------------------------#

if( function_exists('acf_add_options_page') ) {
  $option_page = acf_add_options_page(array(
    'page_title'  => 'Definições Gerais',
    'menu_title'  => 'Definições Gerais',
    'menu_slug'   => 'general-setings',
    'capability'  => 'edit_posts',
    'redirect'  => false
  ));
}

#-----------------------------------------------------------------#
# CONFIG VARIABLES
#-----------------------------------------------------------------#

#-----------------------------------------------------------------#
# Test for half image size for non retina size
# from -> https://stackoverflow.com/questions/9952360/php-wordpress-dynamic-custom-image-sizes
#-----------------------------------------------------------------#

add_image_size( 'product-full', 101 , 102 );
add_image_size( 'product-thumb-retina', 102 , 102 );
add_image_size( 'product-thumb', 103 , 102 );  

add_filter( 'image_resize_dimensions', 'create_bottles_images', 10, 6 );
function create_bottles_images( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ){
  if($dest_w === 101){ //if half image size
    $width = $orig_w/2;
    $height = $orig_h/2;
    return array( 0, 0, 0, 0, $width, $height, $orig_w, $orig_h );
  } 
  else if ($dest_w === 102) {
    $width = $orig_w/4;
    $height = $orig_h/4;
    return array( 0, 0, 0, 0, $width, $height, $orig_w, $orig_h );
  }
  else if ($dest_w === 103) {
    $width = $orig_w/8;
    $height = $orig_h/8;
    return array( 0, 0, 0, 0, $width, $height, $orig_w, $orig_h );
  }
  else { //do not use the filter
      return $payload;
  }
}



function buro_translateStrings($translation_strings, $label) {
  if( class_exists('Polylang') ) {

    for($i = 0, $len = sizeof($translation_strings); $i < $len; $i++) {
      pll_register_string( $translation_strings[$i] , $translation_strings[$i], $label );
    }
  }
}


//Create Pages Controllers
if(class_exists('acf') ) {
  add_action( 'init', 'init_controllers' );
  function init_controllers() {
    $pages_args = [
      'home'
    ];
    buro_createPages($pages_args);
  }

  //Save ACF Jsons in src or build locations to have everything in sync


  if (strpos($_SERVER['HTTP_HOST'], '.local') !== false) {
    add_filter('acf/settings/save_json', 'my_acf_json_save_point_src'); 
    function my_acf_json_save_point_src( $path ) {
      return str_replace('/build/wordpress', '', $_SERVER['DOCUMENT_ROOT']) . '/src/theme/acf-json';
    }
  }
  else {
    add_filter('acf/settings/save_json', 'my_acf_json_save_point_prod'); 
    function my_acf_json_save_point_prod( $path ) {
      return get_stylesheet_directory() . '/acf-json';
    }
  }
} 

//Save post Actions
add_action( 'save_post', 'save_posts_actions', 10, 2 );
function save_posts_actions( $post_ID, $post ) {

  /*Purge cache if exists*/
  if (function_exists('w3tc_pgcache_flush')) { w3tc_pgcache_flush(); }

}

if( class_exists('acf') ) {
  //Remove Buro Plugin from admin
  $master_account = get_field("master_account", "option");
  $current_user = wp_get_current_user();
  if($master_account) :
    if($current_user->ID != $master_account) {
      add_action( 'admin_init', 'remove_buro_plugin' );
      function remove_buro_plugin() {
        remove_menu_page('custom-plugin-options');
      }

      add_filter('pre_site_transient_update_core','remove_core_updates');
      add_filter('pre_site_transient_update_plugins','remove_core_updates');
      add_filter('pre_site_transient_update_themes','remove_core_updates');
    }
  endif;
}

//Add query var to "jobs search filters page"
function add_query_vars($aVars) {
  $aVars[0] = "ajax-id";
  $aVars[1] = "ajax-tax";
  $aVars[2] = "ajax-paged";
  return $aVars;
}
add_filter('query_vars', 'add_query_vars');

?>
