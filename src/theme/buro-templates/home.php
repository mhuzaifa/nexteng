<?php

$current_page = 'home-page';
$current_body_class = 'home';

/*
  IF IS AJAX
  Get the ID of the page/post from query_var and setup post data to use like a regular page
*/
if(get_query_var( 'ajax-id' )) :
  $id = get_query_var( 'ajax-id' );
  global $post;
  $post = get_post($id);
  setup_postdata($post);
endif;

if( class_exists('BuroWordpress') ) {
  $mobile_info = buro_get_mobile();
}
else {
  $mobile_info['type'] = '';
}

if( $mobile_info['type'] == 'phone') $phone = 'phone'; else $phone = '';
if( $mobile_info['type'] == 'tablet') $tablet = 'tablet'; else $tablet = '';


//HOME CONTENT

?>

<!-- ============= CONTENT ============= -->
<div class="page-main page-current" >
  <div class="page-toload <?= $current_page ?>" data-bodyClass="<?= $current_body_class ; ?>">
    <header class="page-header">
    </header>

    <main class="page-content" role="main">
    </main>
  </div>
</div>

<div class="page-main page-next" aria-hidden="true"></div>
<div class="page-main page-prev" aria-hidden="true"></div>
