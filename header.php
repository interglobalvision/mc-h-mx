<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|',true,'right'); bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <?php
    get_template_part('partials/globie');
    get_template_part('partials/seo');
  ?>
  <link rel="dns-prefetch" href="https://code.jquery.com" />
  <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link rel="icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">
  <link rel="shortcut" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.ico">
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon-touch.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('stylesheet_directory'); ?>/img/dist/favicon.png">

  <?php if (is_singular() && pings_open(get_queried_object())) { ?>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
  <?php } ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--[if lt IE 9]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

<section id="main-container">

  <header id="header">
    <div class="container">
      <div class="grid-row">
        <div class="grid-item item-s-10">
          <h1 class="font-size-large"><a href="<?php echo home_url('/info'); ?>"><?php bloginfo('name'); ?></a></h1>
        </div>
        <div class="grid-item item-s-2 text-align-right">
          <?php
            if (!is_home()) { ?>
          <a id="page-close" class="u-inline-block" href="<?php echo home_url(); ?>">
            <?php echo url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/close.svg'); ?>
          </a>
          <?php
            } ?>
        </div>
      </div>
    </div>
  </header>