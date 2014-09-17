<?php
/*
#
#   REGISTER PARENT CSS
#
*/

function lowermedia_enqueue_parent_style() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'lowermedia_enqueue_parent_style' );

function lowermedia_register_my_menu() {
  register_nav_menu('footer-social-menu',__( 'Footer Social Menu' ));
}
add_action( 'init', 'lowermedia_register_my_menu' );