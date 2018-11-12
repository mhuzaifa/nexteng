<?php

/*Get Oembed Video from Youtube/Vimeo*/
function buro_videoEmbed($url) {

  //youtube -> https://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=iwGFalTRHDA&format=json
  //vimeo -> https://vimeo.com/api/oembed.json?url=https://vimeo.com/153776650


  
  // Check for transient
  $key = 'buro_embed_function_' . $url;

  if (WP_DEBUG || false === ( $videoEmbed = get_transient( $key ) ) ) {
    
    if(strpos($url, 'vimeo') !== false) {
      $api_url = 'https://vimeo.com/api/oembed.json?url=' . $url;
    }
    else {
      $api_url = 'https://www.youtube.com/oembed?url=' . $url . '&format=json';
    }

    $response = wp_remote_get( add_query_arg( array(), $api_url ) );

    // Is the API up?
    if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
      return false;
    }

    // Parse the API data and place into an array
    $videoEmbed = json_decode( wp_remote_retrieve_body( $response ), true );

    // Are the results in an array?
    if ( ! is_array( $videoEmbed ) ) {
      return false;
    }
    $videoEmbed = maybe_unserialize( $videoEmbed );
    // Store youtubeFeed in a transient, and expire every hour
    set_transient( $key, $videoEmbed, 24 * HOUR_IN_SECONDS  );
  }
  return $videoEmbed;
}


/*Create Slugs from strings*/
function buro_slugify($text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}


/*Create PAGES and CPT AJAX PAGES automagicaly*/
/*Example : 

$pages_args = [
  'home',
  'legacy',
];
buro_createPages($pages_args);
$ctp_args = [
  'markets'
];
buro_createCPTs($ctp_args);

*/
function buro_createPages($args) {
  $flush_permalinks = false;
  $size = sizeof($args);

  foreach($args as $arg) {
    if( !buroGetPageID( $arg.'-page', 'page' ) ) {
      $flush_permalinks = true;
      $page = array(
        'post_title' => $arg,
        'post_type' => 'page',
        'post_status' => 'publish'
      );
      $page_id = wp_insert_post($page);
      update_field( 'config_current_controller', $arg.'-page', $page_id );
      update_field( 'config_current_page', $arg.'-ajax', $page_id );

      // if( !buroGetPageID( $arg.'-ajax', 'ajax' ) ) {
      //   $page = array(
      //     'post_title' => $arg.'-ajax',
      //     'post_type' => 'ajax',
      //     'post_status' => 'publish'
      //   );
      //   $page_id = wp_insert_post($page);
      //   update_field( 'config_current_controller', $arg.'-ajax', $page_id );
      // }
    }
  }

  /*Flush permalinks*/
  if($flush_permalinks) {
    global $wp_rewrite;
    $wp_rewrite->flush_rules( false );
  }
}

function buro_createCPTs($args) {
  $flush_permalinks = false;
  $size = sizeof($args);

  foreach($args as $arg) {
    if( !buroGetPageID( 'archive-'.$arg.'-ajax', 'ajax' ) ) {
      $flush_permalinks = true;
      $page = array(
        'post_title' => 'archive-'.$arg.'-ajax',
        'post_type' => 'ajax',
        'post_status' => 'publish'
      );
      $page_id = wp_insert_post($page);
      update_field( 'config_current_controller', 'archive-'.$arg.'-ajax', $page_id );
    }

    if( !buroGetPageID( 'single-'.$arg.'-ajax', 'ajax' ) ) {
      $flush_permalinks = true;
      $page = array(
        'post_title' => 'single-'.$arg.'-ajax',
        'post_type' => 'ajax',
        'post_status' => 'publish'
      );
      $page_id = wp_insert_post($page);
      update_field( 'config_current_controller', 'single-'.$arg.'-ajax', $page_id );
    }
  }

  /*Flush permalinks*/
  if($flush_permalinks) {
    global $wp_rewrite;
    $wp_rewrite->flush_rules( false );
  }
}

/**
 * Send debug code to the Javascript console
 */ 
function debug_to_console($data) {
    if(is_array($data) || is_object($data))
  {
    echo("<script>console.log(".json_encode($data).");</script>");
  } else {
    echo("<script>console.log(".$data.");</script>");
  }
}

/*Returns array with social stuff*/
function buro_getShareInfo($id, $home_title, $default_img) {
  //default
  $social = [];
  $social["title"] = "";
  $social["image"] = $default_img;
  $social["description"] = "";
  $social["permalink"] = "";

  // instead of permalink:
  if ( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $social["title"] = "Wine Experience - " . ucwords(strtolower($term->name)) . " | ";
    $social["permalink"] = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
  }
  elseif( is_post_type_archive() ) {
    $social["permalink"] = get_post_type_archive_link( get_query_var('post_type') );
  }
  elseif(is_home()){
    $social["permalink"] = get_bloginfo('url');
    $social["title"] = get_the_title($id);
  }
  elseif(get_query_var( 'ajax-tax' )){
    $tax_query = get_query_var( 'ajax-tax' );
    $term = get_term($tax_query, 'nutricao_cat');

    $social["title"] = $term->name;
    $social["permalink"] = get_term_link( get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
  } // IS AJAX TAXONOMY
  else {
    if($id)
      $social["permalink"] = get_permalink( $id );
    else
      $social["permalink"] = get_bloginfo('url');
  }

  //SOCIAL STUFF

  if(!is_home() && !is_archive() && !is_404()){
    $social["title"] = get_the_title() . " | ";
  }
  else if(is_archive() && !is_tax()){
    $social["title"] = post_type_archive_title("", false) . " | ";
  }
  else if(is_404())
    $social["title"] = "404 | ";

  if( is_single() || is_page() ):
    if(get_field("social_image"))
      $social["image"] = get_field("social_image");
    $social["description"] = get_field("social_description");
  else :
    /*Else*/
  endif;

  if( is_single() && get_post_type() == 'emprego'){
    $social["image"] = 'default_jobs_image.jpg';
  }

  if(is_front_page())
    $social["title"] = "";

  $social["title"] .= get_the_title($id);

  return $social;
}

/*Construct AJAX URL'S*/
function buro_getAjaxUrlPaginationTaxonomy($ajax_url, $ajax_tax, $ajax_paged) {
  $current_lang = pll_current_language();
  $url = '';
  if(pll_default_language() == $current_lang){
    $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-tax=' . $ajax_tax . '&ajax-paged=' . $ajax_paged;
  }
  else{
    $url = site_url() . '/' . $current_lang . '/ajax/' . $ajax_url . '/?ajax-tax=' . $ajax_tax . '&ajax-paged=' . $ajax_paged;
  }
  return $url;
}
function buro_getAjaxUrlPagination($ajax_url, $ajax_paged) {
  $current_lang = pll_current_language();
  $url = '';
  if(pll_default_language() == $current_lang){
    $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-paged=' . $ajax_paged;
  }
  else{
    $url = site_url() . '/' . $current_lang . '/ajax/' . $ajax_url . '/?ajax-paged=' . $ajax_paged;
  }
  return $url;
}
function buro_getAjaxUrlTaxonomy($ajax_url, $tax_name, $tax_id) {
  if(function_exists('pll_current_language')) :
    $current_lang = pll_current_language();
    $url = '';
    if(pll_default_language() == $current_lang){
      $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-tax=' . $tax_id;
    }
    else{
      $url = site_url() . '/' . $current_lang . '/ajax/' . $ajax_url . '/?ajax-tax=' . $tax_id;
    }
    return $url;
  else :
    $url = site_url() . '/ajax/' . $ajax_url . '/?' . $tax_name . '=' . $tax_id;

    return $url;
  endif;
}
function buro_getAjaxUrl($ajax_url, $post_id) {
  if(function_exists('pll_current_language')) :
    $current_lang = pll_current_language();
    $url = '';
    if(pll_default_language() == $current_lang){
      if($post_id == null)
        $url = site_url() . '/ajax/' . $ajax_url;
      else
        $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-id=' . $post_id;
    }
    else{
      if($post_id == null)
        $url = site_url() . '/' . $current_lang . '/ajax/' . $ajax_url;
      else
        $url = site_url() . '/' . $current_lang . '/ajax/' . $ajax_url . '/?ajax-id=' . $post_id;
    }
    return $url;
  else :
    if($post_id == null)
      $url = site_url() . '/ajax/' . $ajax_url;
    else
      $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-id=' . $post_id;
    return $url;
  endif;
}

function buro_getAjaxUrlLang($ajax_url, $post_id, $lang) {

  if($post_id == null)
    if($lang != 'pt')
      $url = site_url() . '/' . $lang . '/ajax/' . $ajax_url;
    else
      $url = site_url() . '/ajax/' . $ajax_url;
  else
    if($lang != 'pt')
      $url = site_url() . '/' . $lang . '/ajax/' . $ajax_url . '/?ajax-id=' . $post_id;
    else
      $url = site_url() . '/ajax/' . $ajax_url . '/?ajax-id=' . $post_id;

  return $url;
}

//Function to get the ID of a page_template for menu usage and so on

function  buro_getTranslatedByClass($current_menu) {
  $pages = get_pages(array(
    'meta_key' => 'config_current_page',
    'meta_value' => $current_menu
  ));

  $page_url = site_url();
  foreach($pages as $page){
    $page_url = pll_get_post($page->ID);
  }
  return $page_url;
}

function  buro_getTranslatedByController($current_controller) {
  $pages = get_posts(array(
    'post_type' => 'page',
    'meta_key' => 'config_current_controller',
    'meta_value' => $current_controller
  ));

  $page_url = site_url();
  foreach($pages as $page){
    $page_url = pll_get_post($page->ID);
  }
  return $page_url;
}

function buro_getTranslatedID($template_page){
  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => $template_page.'.php'
  ));

  $page_url = site_url();
  foreach($pages as $page){
    $page_url = pll_get_post($page->ID);
  }
  return $page_url;
}

// Get the id of a page by its name
function get_page_id($page_name){
  global $wpdb;
  $page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
  return $page_name;
}

// Get the id of a page by its controller
function buroGetPageID($page_controller, $post_type){
  $args = array(
    'meta_key' => 'config_current_controller',
    'meta_value' => $page_controller,
    'post_type' => $post_type,
    'posts_per_page' => 1
  );
  $post = get_posts($args);

  if(sizeof($post))
    return $post[0]->ID;
  else
    return false;
}

function buro_randomNum($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

function buro_getTaxonomyCount($term_id, $taxonomy, $post_type) {

    //return $count;
    $args = array(
      'post_type'     => $post_type, //post type, I used 'product'
      'post_status'   => 'publish', // just tried to find all published post
      'posts_per_page' => -1,  //show all
      'tax_query' => array(
        'relation' => 'AND',
        array(
          'taxonomy' => $taxonomy,  //taxonomy name  here, I used 'product_cat'
          'field' => 'id',
          'terms' => array( $term_id )
        )
      )
    );

    $query = new WP_Query( $args);

    return (int)$query->post_count;

}

//function buro_nextPrevPost($post_type, $filter, $id , $loop, $multi_taxonomy = NULL ) {
function buro_nextPrevPost($args = array(
  'post_type' => NULL,
  'taxonomies' => NULL,
  'attributes' => NULL,
  'post_id' => NULL,
  'loop' => NULL,
  'multi_taxonomy' => NULL
)) {


  $post_type = $args["post_type"];
  $filter = $args["taxonomies"];
  $id = $args["post_id"];
  $loop = $args["loop"];
  $multi_taxonomy = $args["multi_taxonomy"];
  $attributes = $args["attributes"];

  if($filter == NULL) {
    $posts_array = get_posts(array(
      'post_type' => $post_type,
      'orderby'   => 'date',
      'showposts' => '-1'
    ));
   }
   else {
    if($multi_taxonomy == NULL) {
      $posts_array = get_posts(array(
        'post_type' => $post_type,
        'orderby'   => 'date',
        'showposts' => '-1',
        'tax_query' => array( $filter )
      ));
    }
    else {
      $posts_array = get_posts(array(
        'post_type' => $post_type,
        'orderby'   => 'date',
        'showposts' => '-1',
        'tax_query' => array(
          array(
            $filter
          ),
          array (
            'relation' => 'AND',
            $attributes
          )
        )
      ));
    }
  }

    if($id == NULL) {
      $postid = get_the_ID();
    }
    else {
      $postid = $id;
    }
    
    $prev_post_id = 0;
    $next_post_id = 0;
    $posts_num = sizeof($posts_array);

    foreach($posts_array as $index => $post) :
        if( $post->ID == $postid){
            
            if($index == 0 ){
  
              if($loop == true)
                $prev_post_id = $posts_array[$posts_num-1]->ID;
              else
                $prev_post_id = false;
              
              $next_post_id = $posts_array[$index+1]->ID;
            }
            else if($index + 1 ==  $posts_num) {
              if($loop == true) 
                $next_post_id = $posts_array[0]->ID;
              else
                $next_post_id = false;

              $prev_post_id = $posts_array[$index-1]->ID;
            }
            else{
              $prev_post_id = $posts_array[$index-1]->ID;
              $next_post_id = $posts_array[$index+1]->ID;
            }
        }
    endforeach;

    $values = array(
      'prev_post_id' => $prev_post_id,
      'next_post_id' => $next_post_id,
      'number_of_posts' => count($posts_array)
    );
    return $values;
}

function buro_randomGen($min, $max, $quantity) {
  $numbers = range($min, $max);
  shuffle($numbers);
  return array_slice($numbers, 0, $quantity);
}

// retrieves the attachment ID from the file URL
function buro_get_image_id($image_url) {
  global $wpdb;
  $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}

//Data array :
// url -> $instagram['data'][INDEX]['images'][SIZE_OF_IMAGE]['url'] SIZE_OF_IMAGE can be 'low_resolution', 'thumbnail' and 'standard_resolution'
// width -> $instagram['data'][INDEX]['images']['low_resolution']['width']
// height -> $instagram['data'][INDEX]['images']['low_resolution']['height']
// PrimeIT User : 2029662685
// Burocratik User : 1941638099
//Usage :
//    $instagram = buro_get_instagrams( array(
//      'user_id' => '2029662685',
//      'client_id' => 'b4f838a05a7a44b19a5ffb41cea029c1',
//      'count' => '20'
//    ));
function buro_get_instagrams( $args = array() ) {
  // Get args
  $user_id   = ( ! empty( $args['user_id'] ) ) ? $args['user_id'] : '';
  $client_id = ( ! empty( $args['client_id'] ) ) ? $args['client_id'] : '';
  $access_token = ( ! empty( $args['access_token'] ) ) ? $args['access_token'] : '';
  $count     = ( ! empty( $args['count'] ) ) ? $args['count'] : '';
  // If no client id or user id, bail
  if ( empty( $client_id ) || empty( $user_id ) ) {
    return false;
  }
  // Check for transient
  $key = 'buro_instagram_function_' . $user_id;

  if (WP_DEBUG || false === ( $instagrams = get_transient( $key ) ) ) {
    // Ping Instragram's API
    $api_url = 'https://api.instagram.com/v1/users/' . esc_html( $user_id ) . '/media/recent/';
    $response = wp_remote_get( add_query_arg( array(
      'client_id' => esc_html( $client_id ),
      'access_token' => esc_html($access_token),
      'count'     => absint( $count )
    ), $api_url ) );
    // Is the API up?
    if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
      return false;
    }

    // Parse the API data and place into an array
    $instagrams = json_decode( wp_remote_retrieve_body( $response ), true );

    // Are the results in an array?
    if ( ! is_array( $instagrams ) ) {
      return false;
    }
    $instagrams = maybe_unserialize( $instagrams );
    // Store Instagrams in a transient, and expire every hour
    set_transient( $key, $instagrams, 24 * HOUR_IN_SECONDS  );
  }
  return $instagrams;
}

function buro_get_youtubeFeed( $args = array() ) {
  // Get args
  $channel_id   = ( ! empty( $args['channel_id'] ) ) ? $args['channel_id'] : '';
  $api_key = ( ! empty( $args['api_key'] ) ) ? $args['api_key'] : '';
  $count =  ( ! empty( $args['count'] ) ) ? $args['count'] : 5;
  
  // Check for transient
  $key = 'buro_youtube_function_' . $channel_id;

  if (WP_DEBUG || false === ( $youtubeFeed = get_transient( $key ) ) ) {
    // Ping Instragram's API
    $api_url = 'https://www.googleapis.com/youtube/v3/search';

    $response = wp_remote_get( add_query_arg( array(
      'part' => 'snippet',
      'channelId' => esc_html($channel_id),
      'maxResults'     => $count,
      'order' => 'date',
      'type' => 'video',
      'key' => esc_html($api_key)
    ), $api_url ) );

    // Is the API up?
    if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
      return false;
    }

    // Parse the API data and place into an array
    $youtubeFeed = json_decode( wp_remote_retrieve_body( $response ), true );

    // Are the results in an array?
    if ( ! is_array( $youtubeFeed ) ) {
      return false;
    }
    $youtubeFeed = maybe_unserialize( $youtubeFeed );
    // Store youtubeFeed in a transient, and expire every hour
    set_transient( $key, $youtubeFeed, 24 * HOUR_IN_SECONDS  );
  }
  return $youtubeFeed['items'];
}

function buro_get_googlePlusFeed( $args = array() ) {
  // Get args
  $user_id   = ( ! empty( $args['user_id'] ) ) ? $args['user_id'] : '';
  $api_key = ( ! empty( $args['api_key'] ) ) ? $args['api_key'] : '';
  $count =  ( ! empty( $args['count'] ) ) ? $args['count'] : 5;
  
  // Check for transient
  $key = 'buro_googlePlus_function_' . $user_id;

  if (WP_DEBUG || false === ( $googlePlusFeed = get_transient( $key ) ) ) {
    // Ping Instragram's API
    $api_url = 'https://www.googleapis.com/plus/v1/people/' . esc_html( $user_id ) . '/activities/public';

    $response = wp_remote_get( add_query_arg( array(
      'key' => esc_html($api_key)
    ), $api_url ) );
    
    // Is the API up?
    if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
      return false;
    }

    // Parse the API data and place into an array
    $googlePlusFeed = json_decode( wp_remote_retrieve_body( $response ), true );

    // Are the results in an array?
    if ( ! is_array( $googlePlusFeed ) ) {
      return false;
    }
    $googlePlusFeed = maybe_unserialize( $googlePlusFeed );
    // Store googlePlusFeed in a transient, and expire every hour
    set_transient( $key, $googlePlusFeed, 24 * HOUR_IN_SECONDS  );
  }
  return $googlePlusFeed['items'];
}

function buro_get_facebookFeed($args = array() ) {

  $page_id = ( ! empty( $args['page_id'] ) ) ? $args['page_id'] : '';
  $access_token = ( ! empty( $args['access_token'] ) ) ? $args['access_token'] : '';
  $count =  ( ! empty( $args['count'] ) ) ? $args['count'] : 5;

  // Check for transient
  $key = 'buro_facebook_function_' . $page_id;

  if (WP_DEBUG || false === ( $facebook_posts = get_transient( $key ) ) ) {

    $api_url = 'https://graph.facebook.com/v2.10/' . esc_html($page_id) . '/posts';

    $facebook_posts = array();
    

    $response = wp_remote_get( add_query_arg( array(
      'access_token' => esc_html($access_token),
    ), $api_url ) );


    // Is the API up?
    if ( ! 200 == wp_remote_retrieve_response_code( $response ) ) {
      return false;
    }

    // Parse the API data and place into an array
    $facebook_feed = json_decode( wp_remote_retrieve_body( $response ), true );

    
    // Are the results in an array?
    if ( ! is_array( $facebook_feed['data'] ) ) {
      return false;
    }
    $facebook_feed = maybe_unserialize( $facebook_feed );


    foreach($facebook_feed['data'] as $index => $post) {
      if($index < $count) {
        
        $api_url = 'https://graph.facebook.com/v2.10/' . esc_html($post['id']);

        $response = wp_remote_get( add_query_arg( array(
          'fields' => 'attachments',
          'access_token' => esc_html($access_token),
        ), $api_url ) );

        $response = json_decode( wp_remote_retrieve_body( $response ), true );

        $post_info = $response['attachments']['data'][0];

        $post['info'] = $post_info;

        array_push($facebook_posts, $post);

      }
    }

    // Store Instagrams in a transient, and expire every hour
    set_transient( $key, $facebook_posts, 24 * HOUR_IN_SECONDS  );
  }

  return $facebook_posts;
}

//Check if is mobile with built-in wp_is_mobile and browser_version plugin
function buro_is_mobile(){
  //Check for mobile
  $detect = new Mobile_Detect();
  if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS() || $detect->isiOS() )
    return true;
  else
    return false;
}

//Return infor about mobile/browser etc
function buro_get_mobile() {
  //Check for mobile
  $result['mobile'] = '';
  $result['type'] = '';
  $detect = new Mobile_Detect();

  if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS() || $detect->isiOS() ) {
    $result['mobile'] = 'mobile';
  }
  if($detect->isTablet())
    $result['type'] = 'tablet';
  if($detect->isMobile() && !$detect->isTablet())
    $result['type'] = 'phone';

  //Check if is edge
  $result['edge'] = '';
  $user_agent = $_SERVER['HTTP_USER_AGENT'];

  if ( strpos(strtolower($user_agent),'edge') !== false ) {
    $result['edge'] = 'edge';
  }

  // $result['browser_name'] = get_browser_name();
  // $result['browser_version'] = get_browser_version();
  return $result;
}
?>