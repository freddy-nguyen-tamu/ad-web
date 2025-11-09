<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header class="site-header">
    <div class="container header-inner">
      <a class="logo" href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>
      <nav class="nav">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container' => false,
            'items_wrap' => '%3$s'
          ) );
        ?>
        <a href="#contact" class="btn">Contact</a>
      </nav>
    </div>
  </header>
