<?php
$controller = get_field("config_current_controller");

if($controller == 'static')
  get_header('static');
else
  get_header();

/*Stage - Controllers*/
if (is_page('static-simulator')) { include (TEMPLATEPATH . '/stage-templates/simulator.php'); }


/*Pages - Controllers*/
if ($controller == 'simulator-page') { include (TEMPLATEPATH . '/buro-templates/simulator.php'); }
if ($controller == 'home-page') { include (TEMPLATEPATH . '/buro-templates/home.php'); }

if($controller == 'static')
  get_footer('static');
else
  get_footer();

?>