<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header bg-white shadow-sm">
    <div class="container header-inner d-flex align-items-center justify-content-between py-2">
      <a class="logo h4 mb-0 text-decoration-none" href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>
      <nav class="nav d-none d-md-flex align-items-center">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '<ul class="nav">%3$s</ul>'
          ) );
        ?>
        <a href="#contact" class="btn btn-primary ms-3">Contact</a>
      </nav>
    </div>
    <div class="container py-2 d-none d-md-block">
      <?php // header ad zone ?>
      <?php acme_display_ad_zone('header'); ?>
    </div>
  </header>
