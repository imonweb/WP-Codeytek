<?php
/**
 * Custom template tags for the theme.
 *
 * @package Codeytek
 */

/**
 * Gets the thumbnail with Lazy Load.
 * Should be called in the WordPress Loop.
 *
 * @param int|null $post_id               Post ID.
 * @param string   $size                  The registered image size.
 * @param array    $additional_attributes Additional attributes.
 *
 * @return string
 */

function get_the_post_custom_thumbnail( $post_id, $size = 'featured-image', $additional_attributes = [] ){
  $custom_thumbnail = '';

  if( null === $post_id ){
    $post_id = get_the_ID();
  }

  if( has_post_thumbnail( $post_id ) ){
    $default_attributes = [
      'loading' => 'lazy'
    ];
    
    $attributes = array_merge( $additional_attributes, $default_attributes );
    
    $custom_thumbnail = wp_get_attachment_image( 
      get_post_thumbnail_id( $post_id ), 
      $size,
      false,
      $attributes 
    );
  } // $has_post_thumbnail

  return $custom_thumbnail;

} // get_the_post_custom_thumbnail

/**
 * Renders Custom Thumbnail with Lazy Load.
 *
 * @param int    $post_id               Post ID.
 * @param string $size                  The registered image size.
 * @param array  $additional_attributes Additional attributes.
 */
function the_post_custom_thumbnail( $post_id, $size = 'featured-thumbnail', $additional_attributes = [] ) {
	echo get_the_post_custom_thumbnail( $post_id, $size, $additional_attributes );
}

/**
 * Prints HTML with meta information for the current post-date/time.
 *
 * @return void
 */
function codeytek_posted_on() {

	$year                        = get_the_date( 'Y' );
	$month                       = get_the_date( 'n' );
	$day                         = get_the_date( 'j' );
	$post_date_archive_permalink = get_day_link( $year, $month, $day );

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	// Post is modified ( when post published time is not equal to post modified time )
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_attr( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_attr( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'codeytek' ),
		'<a href="' . esc_url( $post_date_archive_permalink ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
} // codeytek_posted_on

/**
 * Prints HTML with meta information for the current author.
 *
 * @return void
 */
function codeytek_posted_by() {
	$byline = sprintf(
		esc_html_x( ' by %s', 'post author', 'codeytek' ),
		'<span class="author vcard"><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline text-secondary">' . $byline . '</span>';
} // codeytek_posted_by

/**
 * Get the trimmed version of post excerpt.
 *
 * This is for modifing manually entered excerpts,
 * NOT automatic ones WordPress will grab from the content.
 *
 * It will display the first given characters ( e.g. 100 ) characters of a manually entered excerpt,
 * but instead of ending on the nth( e.g. 100th ) character,
 * it will truncate after the closest word.
 *
 * @param int $trim_character_count Charter count to be trimmed
 *
 * @return bool|string
 */
function codeytek_the_excerpt( $trim_character_count = 0 ) {
	$post_ID = get_the_ID();

	if ( empty( $post_ID ) ) {
		return null;
	}

	if ( ! has_excerpt() || 0 === $trim_character_count ) {
		the_excerpt();

		return;
	}

	// $excerpt = wp_html_excerpt( get_the_excerpt( $post_ID ), $trim_character_count, '[...]' );
	$excerpt = wp_strip_all_tags( get_the_excerpt( $post_ID ) );
  $excerpt = substr( $excerpt, 0, $trim_character_count );
  $excerpt = substr( $excerpt, 0, strrpos( $excerpt, '' ) );

	echo $excerpt . [];
} // codeytek_the_excerpt

/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 *
 * @return string (Maybe) modified "read more" excerpt string.
 */
function codeytek_excerpt_more( $more = '' ) {

	if ( ! is_single() ) {
		$more = sprintf( '<a class="codeytek-read-more text-white mt-3 btn btn-info" href="%1$s">%2$s</a>',
			get_permalink( get_the_ID() ),
			__( 'Read more', 'codeytek' )
		);
	}

	return $more;
}
