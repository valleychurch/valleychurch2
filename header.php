<!DOCTYPE html>
<!--[if IE 6]>
<html class="ie ie6 no-js">
<![endif]-->
<!--[if IE 7]>
<html class="ie ie7 no-js">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js">
<![endif]-->
<!--[if IE 9]>
<html class="ie ie9 no-js">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js">
<!--<![endif]-->
<head>

  <!-- Meta -->
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <meta name="theme-color" content="#0b94a5" />
  <title><?php wp_title( '&mdash;', true, 'right' ); ?></title>

  <!-- CSS / link tags -->
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <link rel="dns-prefetch" href="//cdn2.valleychurch.eu" />

  <link rel="stylesheet" href="<?php echo valleycdn(); ?>/style.css" />
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />
  <!--[if IE 7]>
  <link rel="stylesheet" type="text/css" href="<?php echo valleycdn(); ?>/font-awesome-ie7.min.css" />
  <![endif]-->

  <link rel="shortcut icon" href="<?php echo valleycdn(); ?>/img/icons/favicon.ico" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo valleycdn(); ?>/img/icons/apple-icon.png" />
  <link rel="icon" sizes="192x192" href="<?php echo valleycdn(); ?>/img/icons/apple-icon.png" />

  <!-- jQuery, Modernizr, Debounce -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js"></script>
  <script>
    function debounce(func, wait, immediate) {
      var result;
      var timeout = null;
      return function() {
        var context = this, args = arguments;
        var later = function() {
          timeout = null;
          if (!immediate) result = func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) result = func.apply(context, args);
        return result;
      };
    }
  </script>

  <!-- Typekit -->
  <script src="//use.typekit.net/gga6pzn.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>

  <!-- WordPress head -->
  <?php wp_head(); ?>
</head>

<body <?php body_class('vc2'); ?>>

  <div class="page-wrap">

    <aside class="side-nav">
      <?php wp_nav_menu( array (
        'container' => false
      ) ); ?>
    </aside>

    <div class="content-wrap cf">

      <a href="#" class="menu-toggle menu-toggle--close"></a>

      <header>
        <section class="container container--header">
          <a class="menu-toggle" href="#">
            <i class="fa fa-lg fa-bars"></i>
          </a>

          <div class="logo-container cf">
            <a href="/" class="logo cf" alt="Valley Church" title="Valley Church">
              <svg class="logo-mark">
                <image xlink:href="<?php echo valleycdn(); ?>/img/icons/icon.svg" src="<?php echo valleycdn(); ?>/img/icons/icon.png" width="100%" height="100%" class="logo-mark"></image>
              </svg>
              <svg width="180" height="28" class="logo-word">
                <image xlink:href="<?php echo valleycdn(); ?>/img/logos/logo.svg" src="<?php echo valleycdn(); ?>/img/logos/logo.png" width="100%" height="100%" class="logo-word"></image>
              </svg>
            </a>
          </div>
          <nav class="main-nav">
            <?php wp_nav_menu( array(
              'container' => false
            ) ); ?>
          </nav>
        </section>
      </header>