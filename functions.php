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
  define( 'CODEYTEK_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

if( ! defined( 'CODEYTEK_BUILD_URI' )  ){
  define( 'CODEYTEK_DIR_URI', untrailingslashit( get_template_directory_uri()  . '/assets/build' ) );
}

if ( ! defined( 'CODEYTEK_BUILD_PATH' ) ) {
	define( 'CODEYTEK_BUILD_PATH', untrailingslashit( get_template_directory() ) . '/assets/build' );
}

if ( ! defined( 'CODEYTEK_BUILD_JS_URI' ) ) {
	define( 'CODEYTEK_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/js' );
}

if ( ! defined( 'CODEYTEK_BUILD_JS_DIR_PATH' ) ) {
	define( 'CODEYTEK_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/js' );
}

if ( ! defined( 'CODEYTEK_BUILD_IMG_URI' ) ) {
	define( 'CODEYTEK_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/src/img' );
}

if ( ! defined( 'CODEYTEK_BUILD_CSS_URI' ) ) {
	define( 'CODEYTEK_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build/css' );
}

if ( ! defined( 'CODEYTEK_BUILD_CSS_DIR_PATH' ) ) {
	define( 'CODEYTEK_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() ) . '/assets/build/css' );
}


// echo '<pre>';
// print_r(CODEYTEK_DIR_PATH);
// echo '</pre>';
// wp_die();
require_once CODEYTEK_DIR_PATH . '/inc/helpers/autoloader.php';
require_once CODEYTEK_DIR_PATH . '/inc/helpers/template-tags.php';

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


 
/* ====== Remove Gutenberg Block Library ====== */
/*
 function ebayads_remove_block_styles(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wp-block-style' ); // Remove WooCommerce block CSS
 }

 add_action( 'wp_enqueue_scripts', 'ebayads_remove_block_styles', 100);
*/



