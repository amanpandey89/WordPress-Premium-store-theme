<?php
/**
 * Premium Store functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Premium_Store
 * @since 1.0.0
 */

if ( ! defined( 'PREMIUM_STORE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'PREMIUM_STORE_VERSION', '1.0.0' );
}

if ( ! function_exists( 'premium_store_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function premium_store_setup() {
		// Add support for block styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );

		// WooCommerce Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
endif;
add_action( 'after_setup_theme', 'premium_store_setup' );

/**
 * Enqueue scripts and styles.
 */
function premium_store_scripts() {
	wp_enqueue_style( 'premium-store-style', get_stylesheet_uri(), array(), PREMIUM_STORE_VERSION );
}
add_action( 'wp_enqueue_scripts', 'premium_store_scripts' );

// Load advanced WooCommerce integration features
require get_template_directory() . '/inc/woocommerce-quick-view.php';
require get_template_directory() . '/inc/woocommerce-wishlist.php';
require get_template_directory() . '/inc/woocommerce-compare.php';
require get_template_directory() . '/inc/woocommerce-ajax-filters.php';
require get_template_directory() . '/inc/demo-import.php';
require get_template_directory() . '/inc/admin-page.php';

// Check for WooCommerce and display an admin notice if not active
function premium_store_woocommerce_missing_notice() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		printf(
			'<div class="notice notice-warning is-dismissible" style="border-left-color: #f5c344;"><p><strong>%1$s</strong> %2$s</p></div>',
			esc_html__( 'Premium Store Theme:', 'premium-store' ),
			esc_html__( 'This theme is highly optimized for eCommerce. Please install and activate WooCommerce to fully utilize its shop capabilities and patterns.', 'premium-store' )
		);
	}
}
add_action( 'admin_notices', 'premium_store_woocommerce_missing_notice' );
