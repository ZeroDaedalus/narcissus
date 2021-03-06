<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Narcissus
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function narcissus_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => false,
	) );
}
add_action( 'after_setup_theme', 'narcissus_jetpack_setup' );
