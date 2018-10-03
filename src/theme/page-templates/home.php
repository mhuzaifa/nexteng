<?php

/*
Template Name: Home
*/

if( class_exists('acf') ) {
	$controller = get_field("config_current_controller");
}
else {
	$controller = '';
}
if($controller == 'static')
  get_header('static');
else
  get_header();

/*Pages - Controllers*/

include (TEMPLATEPATH . '/buro-templates/home.php');

if($controller == 'static')
  get_footer('static');
else
  get_footer();
?>
