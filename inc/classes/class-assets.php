<?php
/**
*
*  Enqueue theme assets 
* 
* @package Codeytek
 **/

namespace Codeytek_Theme\Inc;

use CODEYTEK_THEME\Inc\Traits\Singleton;

class Assets {
  use Singleton;

    protected function __construct(){

    // wp_die('hello');

    // load class.
    $this->setup_hooks();
  } 

  protected function setup_hooks(){
    
    /*  
    * Actions
    */

    add_action( 'wp_enqueue_scripts', [ $this, 'register_styles' ]);
    add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ]);
  }

  public function register_styles(){
    /*  Register Styles */
    // wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( CODEYTEK_DIR_PATH . '/style.css'), 'all');
    wp_register_style( 'bootstrap-css', CODEYTEK_DIR_URI . '/assets/src/library/bootstrap/css/bootstrap.min.css', [], false, 'all');
    wp_register_style( 'main-css', CODEYTEK_BUILD_CSS_URI . '/main.css', ['bootstrap-css'], filemtime( CODEYTEK_BUILD_CSS_DIR_PATH . '/main.css' ), 'all' );

    /*  Enqueue Styles */
    wp_enqueue_style('bootstrap-css');
    wp_enqueue_style('style-css');
    wp_enqueue_style('main-css');
    
  }

  public function register_scripts(){
    /*  Register Scripts */
    // wp_register_script( 'bootstrap-js', CODEYTEK_DIR_URI . '/assets/src/library/bootstrap/js/bootstrap.min.js', [ 'jquery' ], false, true );
    // wp_register_script( 'main-js', CODEYTEK_DIR_URI . '/assets/main.js', ['jquery'], filemtime( CODEYTEK_DIR_PATH . '/assets/main.js'), true );
    wp_register_script( 'main-js', CODEYTEK_BUILD_JS_URI . '/main.js', ['jquery'], filemtime( CODEYTEK_BUILD_JS_DIR_PATH . '/main.js'), true );
     wp_register_script( 'bootstrap-bundle-js', CODEYTEK_DIR_URI . '/assets/src/library/bootstrap/js/bootstrap.bundle.min.js', [ 'jquery' ], false, true );
  
  
  /*  Enqueue Scripts */
  wp_enqueue_script('main-js');
  // wp_enqueue_script('bootstrap-js');
  wp_enqueue_script('bootstrap-bundle-js');
  }
}