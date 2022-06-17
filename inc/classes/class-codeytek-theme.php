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

    // wp_die('hello');

    // load class.
    $this->set_hooks();
  } 

  protected function set_hooks(){
    // actions and filters
  }
}