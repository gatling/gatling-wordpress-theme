<?php

function add_styles() {
  if (!is_admin()) {
    wp_register_style( 'main', get_template_directory_uri() .'/assets/css/main.min.css', array(), '20190423');
    wp_enqueue_style( 'main' );

    wp_register_style( 'slick', get_template_directory_uri() .'/assets/css/vendor/slick.css', array(), '20190423');
    wp_enqueue_style( 'slick' );

    wp_register_style( 'slick-theme', get_template_directory_uri() .'/assets/css/vendor/slick-theme.css', array(), '20190423');
    wp_enqueue_style( 'slick-theme' );

    wp_register_style( 'fancybox', get_template_directory_uri() .'/assets/css/vendor/jquery.fancybox.css', array(), '20190423');
    wp_enqueue_style( 'fancybox' );

    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700', false );
  }
}

add_action('wp_enqueue_scripts', 'add_styles');
