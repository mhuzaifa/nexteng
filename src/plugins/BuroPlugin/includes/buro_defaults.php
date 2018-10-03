<?php

// remove_filter ('acf_the_content', 'wpautop');

/*
 * Custom filter to remove default image sizes from WordPress.
 */
 
/* Add the following code in the theme's functions.php and disable any unset function as required */
function remove_default_image_sizes( $sizes ) {
  
  /* Default WordPress */
  unset( $sizes[ 'small' ]);          // Remove Thumbnail (150 x 150 hard cropped)
  unset( $sizes[ 'medium' ]);          // Remove Medium resolution (300 x 300 max height 300px)
  unset( $sizes[ 'medium_large' ]);    // Remove Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
  unset( $sizes[ 'large' ]);           // Remove Large resolution (1024 x 1024 max height 1024px)
  
  return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );

#-----------------------------------------------------------------#
# Test for half image size for non retina size
# from -> https://stackoverflow.com/questions/9952360/php-wordpress-dynamic-custom-image-sizes
#-----------------------------------------------------------------#

//add_image_size('non-retina', 101, 102);
//add_filter( 'image_resize_dimensions', 'half_image_resize_dimensions', 10, 6 );
function half_image_resize_dimensions( $payload, $orig_w, $orig_h, $dest_w, $dest_h, $crop ){
  if($dest_w === 101){ //if half image size
      $width = $orig_w/2;
      $height = $orig_h/2;
      return array( 0, 0, 0, 0, $width, $height, $orig_w, $orig_h );
  } else { //do not use the filter
      return $payload;
  }
}

#-----------------------------------------------------------------#
# STRIP COPY/PASTE TAGS FROM WORD
#-----------------------------------------------------------------#
add_filter('tiny_mce_before_init','configure_tinymce');

/**
 * Customize TinyMCE's configuration
 *
 * @param   array
 * @return  array
 */
function configure_tinymce($in) {
  $in['paste_preprocess'] = "function(plugin, args){
    // Strip all HTML tags except those we have whitelisted
    var whitelist = 'p,span,b,strong,i,em,h3,h4,h5,h6,ul,li,ol';
    var stripped = jQuery('<div>' + args.content + '</div>');
    var els = stripped.find('*').not(whitelist);
    for (var i = els.length - 1; i >= 0; i--) {
      var e = els[i];
      jQuery(e).replaceWith(e.innerHTML);
    }
    // Strip all class and id attributes
    stripped.find('*').removeAttr('id').removeAttr('class');
    // Return the clean HTML
    args.content = stripped.html();
  }";
  return $in;
}

#-----------------------------------------------------------------#
# DISABLE WORDPRESS STANDARD STUFF
#-----------------------------------------------------------------#
  //Remove Editor from pages
  // function remove_editor() {
  //   remove_post_type_support('page', 'editor');
  // }
  // add_action('admin_init', 'remove_editor');

  // Disable comments and ping
  add_action( 'wp_loaded', 'buro_disable_all_comments_and_pings' );
  function buro_disable_all_comments_and_pings() {
    // Turn off comments
    if( '' != get_option( 'default_ping_status' ) ) {
      update_option( 'default_ping_status', '' );
    }

    // Turn off pings
    if( '' != get_option( 'default_comment_status' ) ) {
      update_option( 'default_comment_status', '' );
    }
  }

  // Html5 Styles
  add_filter('style_loader_tag', 'html5_style_tag');
  function html5_style_tag($tag){
      $tag = preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
      $tag = preg_replace('~\s+media=["\'][^"\']++["\']~', '', $tag);
      $tag = preg_replace("#\s(id|class)='[^']+'#", '', $tag);
      return $tag;
  }

  // Disable All Updates - NOTE: Need to find another way, this makes the BO slow as shit
  #add_filter('pre_site_transient_update_core','remove_core_updates');
  #add_filter('pre_site_transient_update_plugins','remove_core_updates');
  #add_filter('pre_site_transient_update_themes','remove_core_updates');
  function remove_core_updates(){
    $disable = get_field("disable_updates", "option");
    if($disable) return;
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
  }

  // Removes WordPress version from scripts
  add_filter('style_loader_src', 'theme_remove_version_code', 99);
  add_filter('script_loader_src', 'theme_remove_version_code', 99);
  function theme_remove_version_code($src) {
    if (strpos($src, 'ver=') !== false) {
      $src = remove_query_arg('ver', $src);
    }
    return $src;
  }

  // Header cleanup
  add_action('wp_loaded', 'theme_cleanup', 16);
  function theme_cleanup() {
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  }

  //Disable W3 Total Cache Comment
  add_filter( 'w3tc_can_print_comment', function( $w3tc_setting ) { return false; }, 10, 1 );

#-----------------------------------------------------------------#
# MEDIA LIB
#-----------------------------------------------------------------#

  // Fix SVG and WebP import and visualization on admin
  function svg_webp_mime_type( $mimes = array() ) {
      $mimes['svg']  = 'image/svg+xml';
      $mimes['svgz'] = 'image/svg+xml';
      $mimes['webp'] = 'image/webp';
      return $mimes;
  }
  add_filter( 'upload_mimes', 'svg_webp_mime_type' );

  // Prevent Default ImageSizes Generation
  add_action( 'wp_loaded', 'buro_image_size_prevent' );
  function buro_image_size_prevent() {
      update_option('thumbnail_size_w', 0);
      update_option('thumbnail_size_h', 0);
      update_option('medium_size_w', 0);
      update_option('medium_size_h', 0);
      update_option('large_size_w', 0);
      update_option('large_size_h', 0);

  }

  add_action( 'wp_loaded', 'buro_image_sizes' );
  function buro_image_sizes() {
    $image_sizes = get_field("image_sizes", "option");
    if($image_sizes)
      foreach( $image_sizes as $image_size ) :
        add_image_size( $image_size["image_slug"], $image_size["image_width"], $image_size["image_height"], $image_size["hard_crop"] );
      endforeach;
  }

  //Filter By File Type
  add_filter('post_mime_types', 'modify_post_mime_types');
  function modify_post_mime_types($post_mime_types) {
    $post_mime_types['application/pdf'] = array(__('PDF'), __('Manage PDF'), _n_noop('PDF <span class="count">(%s)</span>', 'PDF <span class="count">(%s)</span>'));
    return $post_mime_types;
  }

#-----------------------------------------------------------------#
# CUSTOM ADMIN
#-----------------------------------------------------------------#

function no_wp_logo_admin_bar_remove() {
  $logo = get_field("logo_admin","option");
  if($logo == "")
    $logo = plugin_dir_url(__FILE__) . 'assets/buro-logo-admin.svg';
  ?>
    <style type="text/css">
      #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
        content: url(<?php echo $logo; ?>) !important;
        top: 3px;
        left: 3px;
      }
      #wpadminbar #wp-admin-bar-wp-logo>.ab-item .ab-icon {
        width: 140px;
      }
      #wpadminbar #wp-admin-bar-wp-logo > a.ab-item {
        pointer-events: none;
        cursor: default;
      }
    </style>
  <?php
}
add_action('wp_before_admin_bar_render', 'no_wp_logo_admin_bar_remove', 0);

  // Custom login page
  function my_login_logo() {
    $logo = get_field("login_page_logo","option");
    $color = get_field("login_page_color","option");

    if($logo == "")
      $logo = plugin_dir_url(__FILE__) . 'assets/buro-logo.svg';
    ?>
    <style type="text/css">
      body.login div#login h1 a {
        position: relative;
        background-image: url(<?php echo $logo; ?>);
        padding-bottom: 0px;
        height: 70px;
        background-size: contain;
        width: 100%;
      }

      body{
        background: <?php echo $color; ?>!important;
      }

      .login h1 a{
        width: 100%;
        background-size: auto;
        -webkit-background-size: auto;
      }

      .login #backtoblog a, .login #nav a{
        color: #fff !important;
      }

      .wp-core-ui .button-primary{
        color: #006cfc!important;
        background:  <?php echo $color; ?>!important;
        border: 1px solid  #006cfc!important;
        box-shadow: none!important;        
        text-shadow: none!important;
        opacity: .9;
        padding: 0 12px 2px;
      } 

      .wp-core-ui .button-primary:hover, .wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:focus{
        background: #006cfc!important;
        color: #ffffff!important;
        border: 1px solid  #006cfc!important;
        box-shadow: none!important;
        opacity: 1;
        padding: 0 12px 2px;
      }
    </style>
  <?php }
  add_action( 'login_enqueue_scripts', 'my_login_logo' );

  add_filter( 'login_headerurl', 'custom_loginlogo_url' );
  function custom_loginlogo_url($url) {
    return site_url();
  }
#-----------------------------------------------------------------#
# STUFF CSS
#-----------------------------------------------------------------#

  // Add a Custom CSS file to WP Admin Area
  function admin_theme_style() {
    wp_enqueue_style('buro-admin-style', plugin_dir_url(__FILE__) . 'assets/buro-admin.css');
    wp_enqueue_script('buro-admin-script', plugin_dir_url(__FILE__) . 'assets/buro-admin.js', array('jquery'));

    wp_enqueue_style('theme-admin-style', get_template_directory_uri() . '/inc/theme-admin.css');
    wp_enqueue_script('theme-admin-script', get_template_directory_uri() . '/inc/theme-admin.js', array('jquery'));
  }
  add_action('admin_enqueue_scripts', 'admin_theme_style');


#-----------------------------------------------------------------#
# CONFIG VARIABLES
#-----------------------------------------------------------------#

  //Save Control Variables on "Page" save
  add_action( 'save_post', 'save_page_vars', 10, 2 );
  function save_page_vars( $post_ID, $post ) {

    if(get_field('social_title') === false || get_field('social_title') === '')
      update_field( 'social_title', $post->post_title, $post_ID );

    if(get_field('social_description') === false || get_field('social_description') === '')
      update_field( 'social_description', $post->post_title, $post_ID );
  }
?>