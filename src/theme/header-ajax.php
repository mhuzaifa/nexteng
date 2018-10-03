<?php
header('HTTP/1.1 200 OK');
show_admin_bar(false);
remove_all_actions('wp_footer', 1);
remove_all_actions('wp_header', 1);
?>
<!DOCTYPE html>