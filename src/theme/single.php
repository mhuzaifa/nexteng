<?php

get_header();

$post_type = get_post_type();

/*Single Custom Post Types*/
if ($post_type == 'product') { include (TEMPLATEPATH . '/buro-templates/single-bottles.php'); }

get_footer();

?>