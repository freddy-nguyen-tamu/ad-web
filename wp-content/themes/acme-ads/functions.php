<?php
/**
 * Acme Ads Theme Functions
 */

if ( ! function_exists( 'acme_setup' ) ) {
    function acme_setup() {
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-logo' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'acme-ads' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'acme_setup' );

function acme_enqueue_scripts() {
    wp_enqueue_style( 'acme-style', get_stylesheet_uri(), array(), '1.0' );
    // enqueue a small main.js
    wp_enqueue_script( 'acme-main', get_template_directory_uri() . '/js/main.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'acme_enqueue_scripts' );

// Add simple customizer settings
function acme_customize_register( $wp_customize ) {
    $wp_customize->add_section('acme_hero', array('title'=>'Hero Settings','priority'=>30));
    $wp_customize->add_setting('acme_hero_heading', array('default'=>'Grow faster with performance advertising'));
    $wp_customize->add_setting('acme_hero_sub', array('default'=>'Targeted campaigns that increase leads and lower cost-per-acquisition.'));
    $wp_customize->add_control('acme_hero_heading', array('label'=>'Hero Heading','section'=>'acme_hero','type'=>'text'));
    $wp_customize->add_control('acme_hero_sub', array('label'=>'Hero Subtext','section'=>'acme_hero','type'=>'textarea'));
}
add_action('customize_register', 'acme_customize_register');
