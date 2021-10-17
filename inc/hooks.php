<?php
/**
 * Custom hooks
 *
 * @package itechstarter
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'itechstarter_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function itechstarter_site_info() {
		do_action( 'itechstarter_site_info' );
	}
}

add_action( 'itechstarter_site_info', 'itechstarter_add_site_info' );
if ( ! function_exists( 'itechstarter_add_site_info' ) ) {
	/**
	 * Add site info content.
	 */
	function itechstarter_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s(%4$s)',
			esc_url( __( 'https://wordpress.org/', 'itechstarter' ) ),
			sprintf(
				/* translators: WordPress */
				esc_html__( 'Proudly powered by %s', 'itechstarter' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: 1: Theme name, 2: Theme author */
				esc_html__( 'Theme: %1$s by %2$s.', 'itechstarter' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'https://itechstarter.com', 'itechstarter' ) ) . '">itechstarter.com</a>'
			),
			sprintf( // WPCS: XSS ok.
				/* translators: Theme version */
				esc_html__( 'Version: %1$s', 'itechstarter' ),
				$the_theme->get( 'Version' )
			)
		);

		// Check if customizer site info has value.
		if ( get_theme_mod( 'itechstarter_site_info_override' ) ) {
			$site_info = get_theme_mod( 'itechstarter_site_info_override' );
		}

		echo apply_filters( 'itechstarter_site_info_content', $site_info ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
}
