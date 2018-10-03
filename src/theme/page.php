<?php
$controller = get_field("config_current_controller");

if($controller == 'static')
  get_header('static');
else
  get_header();

/*Pages - Controllers*/

if ($controller == 'home-page') { include (TEMPLATEPATH . '/buro-templates/home.php'); }

if($controller == 'static')
  get_footer('static');
else
  get_footer();

?>