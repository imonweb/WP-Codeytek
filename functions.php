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
  /*  Register Styles */
  wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css'), 'all');
  wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/assets/src/library/bootstrap/css/bootstrap.min.css', [], false, 'all');

  /*  Register Scripts */
  wp_register_script( 'main-js', get_template_directory_uri(  ) . '/assets/main.js', [], filemtime( get_template_directory() . '/assets/main.js'), true );
  wp_register_script( 'bootstrap-js', get_template_directory_uri(  ) . '/assets/src/library/bootstrap/js/bootstrap.min.js', [ 'jquery' ], false, true );
  
  /*  Enqueue Styles */
  wp_enqueue_style('style-css');
  wp_enqueue_style('bootstrap-css');
  /*  Enqueue Scripts */
  wp_enqueue_script('main-js');
  wp_enqueue_script('bootstrap-js');

/*
  wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( get_template_directory() . '/style.css'), 'all' );
  if( is_archive()) {
    wp_enqueue_style( 'style-css');
  }
*/
}

add_action( 'wp_enqueue_scripts', 'codeytek_enqueue_scripts');