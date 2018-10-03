<?php

get_header('ajax');

/*AJAX - Controllers*/
$controller = get_field("config_current_controller");

if ($controller == 'home-ajax') { include (TEMPLATEPATH . '/buro-templates/home.php'); }

get_footer('ajax');

?>