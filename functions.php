<?php
/**
*
*  Theme Functions 
* 
*  @package Codeytek
*
 **/

if( ! defined( 'CODEYTEK_DIR_PATH' ) ){
  define( 'CODEYTEK_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if( ! defined( 'CODEYTEK_DIR_URI' )  ){
 ! define( 'CODEYTEK_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

// echo '<pre>';
// print_r(CODEYTEK_DIR_PATH);
// echo '</pre>';
// wp_die();
require_once CODEYTEK_DIR_PATH . '/inc/helpers/autoloader.php';

function codeytek_get_theme_instance(){
\CODEYTEK_THEME\Inc\CODEYTEK_THEME::get_instance();

}
codeytek_get_theme_instance();
 
  

function codeytek_enqueue_scripts(){
   

/*
  wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css'), 'all' );
  if( is_archive()) {
    wp_enqueue_style( 'style-css');
  }
*/
}

add_action( 'wp_enqueue_scripts', 'codeytek_enqueue_scripts');