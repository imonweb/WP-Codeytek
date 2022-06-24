<?php
/**
 * Block Patterns
 *
 * @package Codeytek
 */

namespace CODEYTEK_THEME\Inc;

use CODEYTEK_THEME\Inc\Traits\Singleton;

class Block_Patterns {
	use Singleton;

	protected function __construct() {

		// load class.
		$this->setup_hooks();
	}

	protected function setup_hooks() {

		/**
		 * Actions.
		 */
		add_action( 'init', [ $this, 'register_block_patterns' ] );
		add_action( 'init', [ $this, 'register_block_pattern_categories' ] );
	}

	public function register_block_patterns() {
		if ( function_exists( 'register_block_pattern' ) ) {

			/**
			 * Cover Pattern
			 */
			$cover_content = $this->get_pattern_content( 'template-parts/patterns/cover' );

			register_block_pattern(
				'codeytek/cover',
				[
					'title' => __( 'Codeytek Cover', 'codeytek' ),
					'description' => __( 'Codeytek Cover Block with image and text', 'codeytek' ),
					'categories' => [ 'cover' ],
					// 'content' => $cover_content,
          'content' => "<!-- wp:cover {\"url\":\"http://localhost/wp/codeytek/wp-content/uploads/2022/06/hotel.jpg\",\"id\":77,\"dimRatio\":50,\"contentPosition\":\"center center\",\"isDark\":false,\"align\":\"full\"} -->
<div class=\"wp-block-cover alignfull is-light codeytek-cover\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim\"></span><img class=\"wp-block-cover__image-background wp-image-77\" alt=\"\" src=\"http://localhost/wp/codeytek/wp-content/uploads/2022/06/hotel.jpg\" data-object-fit=\"cover\"/><div class=\"wp-block-cover__inner-container\"><!-- wp:heading {\"textAlign\":\"center\",\"level\":1,\"align\":\"full\",\"textColor\":\"white\"} -->
<h1 class=\"alignfull has-text-align-center has-white-color has-text-color\">Never let your memories be greater than your dream</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#dedede\"}}} -->
<p class=\"has-text-align-center has-text-color\" style=\"color:#dedede\">A mind that is stretched by a new experience can never go back its old dimensions.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class=\"wp-block-buttons\"><!-- wp:button {\"backgroundColor\":\"vivid-cyan-blue\",\"align\":\"center\"} -->
<div class=\"wp-block-button aligncenter\"><a class=\"wp-block-button__link has-vivid-cyan-blue-background-color has-background\">Blogs</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div></div>
<!-- /wp:cover -->"
				]
			);

			/**
			 * Two Column Pattern
			 */
			$two_columns_content = $this->get_pattern_content( 'template-parts/patterns/two-columns' );

			register_block_pattern(
				'codeytek/two-columns',
				[
					'title' => __( 'Codeytek Two Column', 'codeytek' ),
					'description' => __( 'Codeytek two columns with heading and text', 'codeytek' ),
					'categories' => [ 'columns' ],
					'content' => $two_columns_content,
				]
			);
		}
	}

	public function get_pattern_content( $template_path ) {

		ob_start();

		get_template_part( $template_path );

		$pattern_content = ob_get_contents();

		ob_end_clean();

		return $pattern_content;
	}

	public function register_block_pattern_categories() {

		$pattern_categories = [
			'cover' => __( 'Cover', 'codeytek' ),
			'columns' => __( 'Columns', 'codeytek' ),
		];

		if ( ! empty( $pattern_categories ) && is_array( $pattern_categories ) ) {
			foreach ( $pattern_categories as $pattern_category => $pattern_category_label ) {
				register_block_pattern_category(
					$pattern_category,
					[ 'label' => $pattern_category_label ]
				);
			}
		}
	}


}
