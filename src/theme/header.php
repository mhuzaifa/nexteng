<!--
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
BBÜÜ                                                      ÜÜRO
BBÜÜ                                                      ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB      ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB         ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB           ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB             ÜÜRO
BBÜÜ     BBBBBBBBB         BBBBBBBBBBBBBBB                ÜÜRO
BBÜÜ     BBBBBBBBB       BBBBBBBBBBBBBBB                  ÜÜRO
BBÜÜ     BBBBBBBBB    BBBBBBBBBBBBBBB                     ÜÜRO
BBÜÜ     BBBBBBBBB  BBBBBBBBBBBBBBB                       ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB       ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB         ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB            ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB              ÜÜRO
BBÜÜ     BBBBBBBBB         BBBBBBBBBBBBBBB                ÜÜRO
BBÜÜ     BBBBBBBBB      BBBBBBBBBBBBBBB                   ÜÜRO
BBÜÜ     BBBBBBBBB    BBBBBBBBBBBBBBB                     ÜÜRO
BBÜÜ     BBBBBBBBB BBBBBBBBBBBBBBB                        ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBBBB                          ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBBBBB                            ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBBBB                               ÜÜRO
BBÜÜ     BBBBBBBBBBBBBBBB                                 ÜÜRO
BBÜÜ     BBBBBBBBBBBBB                                    ÜÜRO
BBÜÜ     BBBBBBBBBBB                                      ÜÜRO
BBÜÜ     BBBBBBBB                                         ÜÜRO
BBÜÜ     BBBBBB                                           ÜÜRO
BBÜÜ     BBBB                                             ÜÜRO
BBÜÜ     B                                                ÜÜRO
BBÜÜ                                                      ÜÜRO
BBÜÜ                                                      ÜÜRO
BBUU     BUROCRATIK.COM                                   UURO
BBÜÜ                                                      ÜÜRO
BBÜÜ                                                      ÜÜRO
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
BBÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜÜRO
-->
<!doctype html>
<html class="no-js" lang="en">

<head>
  <?php
    if( class_exists('acf') ) {
      $social = buro_getShareInfo(
          $post->ID,
          "NEXT",
          site_url('public/imgs/social/social-default.jpg'),
          "NEXT"
        );
    }
    else {
        $social['title'] = '';
        $social['description'] = '';
        $social['image'] = '';
    }
    ?>
  <meta name="google-site-verification" content="EyGHDO_9tYN_OK8KjDphjA8JPagYRFY8iayd22IunnM" />
  <meta charset=utf-8>
  <title>
    <?= $social["title"]; ?>
  </title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="google-site-verification" content="">
  <meta name="description" content="<?= $social[" description"]; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="author" content="burocratik.com">
  <link rel="author" href="humans.txt">
  <link rel="canonical" href="<?= $social[" permalink"]; ?>">

  <link rel="alternate" hreflang="en" href="######">

  <!-- Sharing -->
  <meta property="og:title" content="<?= $social[" title"]; ?>">
  <meta property="og:url" content="<?= $social[" permalink"]; ?>">
  <meta property="og:image" content="<?= $social[" image"]; ?>">
  <meta property="og:site_name" content="<?= $social[" title"]; ?>">
  <meta property="og:description" content="<?= $social[" description"]; ?>">
  <meta property="article:publisher" content="facebook link" />
  <meta property="article:author" content="facebook link" />

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="twitter link">
  <meta name="twitter:title" content="<?= $social[" title"]; ?>">
  <meta name="twitter:description" content="<?= $social[" description"]; ?>">
  <meta name="twitter:image" content="<?= $social[" image"]; ?>">
  <!-- Icons --> 
  <link rel="apple-touch-icon" sizes="180x180" href="public/imgs/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="public/imgs/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="public/imgs/favicon/favicon-16x16.png">
        <link rel="manifest" href="public/imgs/favicon/manifest.json">
        <link rel="mask-icon" href="public/imgs/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="public/imgs/favicon/favicon.ico">
   
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-config" content="/public/imgs/id/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">


  <?php if (defined('ENVIRONMENT')) : ?>
  <?php if (ENVIRONMENT == 'development' ): ?>
  <link rel="stylesheet" href="/public/scripts/styles.css">
  <?php else: ?>
  <link rel="stylesheet" href="/public/scripts/styles.min.css">
  <?php endif; ?>
  <?php else : ?>
  <link rel="stylesheet" href="/public/scripts/styles.min.css">
  <?php endif; ?>

  <script src="/public/scripts/css_browser_selector.min.js"></script>
  <script src="/public/scripts/modernizr.custom.js"></script>



</head>

<?php

if( class_exists('BuroWordpress') ) {
    $mobile_info = buro_get_mobile();
    $mobile = buro_is_mobile() ? "mobile" : "";
}
else {
     $mobile_info['type'] = '';
}
if( $mobile_info['type'] == 'phone') $phone = 'phone'; else $phone = '';
if( $mobile_info['type'] == 'tablet') $tablet = 'tablet'; else $tablet = '';


?>

<body class="js-byrefresh js-no-ajax <?= $mobile; ?> <?= $phone; ?> <?= $tablet; ?> ">


  <?php #include_once('buro-templates/main-header.php'); ?>



  <div class="scroll-content-wrapper">