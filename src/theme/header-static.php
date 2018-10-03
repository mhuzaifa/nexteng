<!doctype html>
<html class="no-js" lang="en">
  <head>
    <?php #$social = buro_getShareInfo($post->ID, "Sr. Basílio", site_url('public/imgs/social/basilio-social-default.jpg')); ?>

    <meta charset=utf-8>
    <title>TITLE</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="google-site-verification" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="author" content="burocratik.com">
    <link rel="author" href="humans.txt">
    <link rel="canonical" href="#">

    <!-- Sharing -->
    <meta property="og:title" content="TITLE">
    <meta property="og:url" content="#">
    <meta property="og:image" content="#">
    <meta property="og:site_name" content="SITE_NAME">
    <meta property="og:description" content="DESCRIPTION">
    <meta property="article:publisher" content="https://www.facebook.com/burocratik/"/>
    <meta property="article:author" content="https://www.facebook.com/burocratik"/>

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@TITLE">
    <meta name="twitter:title" content="TITLE">
    <meta name="twitter:description" content="DESCRIPTION">
    <meta name="twitter:image" content="#">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="public/imgs/id/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="public/imgs/id/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="public/imgs/id/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="public/imgs/id/manifest.json">
    <link rel="mask-icon" href="public/imgs/id/safari-pinned-tab.svg" color="#0000fe">
    <link rel="shortcut icon" href="public/imgs/id/favicon.ico">
    <meta name="msapplication-config" content="public/imgs/id/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <?php if (ENVIRONMENT == 'development' ): ?>
      <link rel="stylesheet" href="/public/js/plugins_default/bower_components/outdated-browser/outdatedbrowser/outdatedbrowser.css">
      <link rel="stylesheet" href="/public/css/foundation.css">
      <link rel="stylesheet" href="/public/css/styles.css">

    <?php else: ?>
      <link rel="stylesheet" href="/public/scripts/app.min.css">
    <?php endif; ?>

    <script src="/public/js/plugins_default/bower_components/css-browser-selector/css_browser_selector.js"></script>
    <script src="/public/js/plugins_default/bower_components/Modernizr/modernizr.custom.js"></script>

  </head>

<?php
$mobile_info = buro_get_mobile();
$mobile = buro_is_mobile() ? "mobile" : "";
if( $mobile_info['type'] == 'phone') $phone = 'phone'; else $phone = '';
?>

<body class="js-byrefresh js-no-ajax <?= $mobile; ?> <?= $phone; ?>">

  <header id="header-main" role="banner">
    <nav id="nav-main" class="row align-middle" role="navigation">

    </nav>
  </header>