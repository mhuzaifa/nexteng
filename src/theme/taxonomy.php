<?php

get_header();


$post_type = get_post_type();


global $wp_query;

$type_of_taxonomy = $wp_query->tax_query->queries[0]["taxonomy"];

/*Archive Custom Post Types - Formação*/
if ($type_of_taxonomy == 'tipo_de_formacao') { include (TEMPLATEPATH . '/buro-templates/archive-formacoes.php'); }
if ($type_of_taxonomy == 'estado_da_formacao') { include (TEMPLATEPATH . '/buro-templates/archive-formacoes.php'); }

get_footer();

?>
