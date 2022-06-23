<?php
/**
*
*  Bootstrap the Theme 
*
* @package codeytek
 **/

namespace CODEYTEK_THEME\Inc;

use CODEYTEK_THEME\Inc\Traits\Singleton;

class CODEYTEK_THEME {
  use Singleton;
  

  protected function __construct(){

    // load class.

    Assets::get_instance();
    Menus::get_instance();
    Meta_Boxes::get_instance();

    $this->setup_hooks();
  } // __construct

  protected function setup_hooks(){
    
    /*  
    * Actions
    */
    add_action( 'after_setup_theme', [ $this, 'setup_theme'] );
 
  } // setup_hooks

  public function setup_theme(){
    add_theme_support( 'title-tag' );

    add_theme_support( 'custom-logo', [
        'header-text'          => array( 'site-title', 'site-description' ),
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
    ] );

    /**
		 * Adds Custom background panel to customizer.
		 *
		 * @see Enable Custom Backgrounds
		 * @link https://developer.wordpress.org/themes/functionality/custom-backgrounds/#enable-custom-backgrounds
		 */

    	
    add_theme_support( 'custom-background' );
    $defaults = array(
        'default-color'          => '#fff',
        'default-image'          => '',
        'default-repeat'         => 'no-repeat',
    );
    add_theme_support( 'custom-background', $defaults );

    /**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * Adding this will allow you to select the featured image on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */

    add_theme_support( 'post-thumbnails' );

    /**
		 * Register image sizes.
		 */
		add_image_size( 'featured-thumbnail', 350, 233, true );


    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

    add_editor_style();
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    global $content_width;
    if( ! isset( $content_width )) {
      $content_width = 1240;
    }


  } /*  setup_theme */

} // class CODEYTEK_THEME