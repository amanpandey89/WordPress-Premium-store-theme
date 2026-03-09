<?php
/**
 * WooCommerce Quick View Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function premium_store_quick_view_scripts() {
	if ( function_exists( 'is_woocommerce' ) ) {
		// Enqueue simple script to handle quick view modal
		wp_enqueue_script( 'premium-store-quick-view', get_template_directory_uri() . '/assets/js/quick-view.js', array( 'jquery' ), PREMIUM_STORE_VERSION, true );
		wp_localize_script( 'premium-store-quick-view', 'premium_store_qv_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	}
}
add_action( 'wp_enqueue_scripts', 'premium_store_quick_view_scripts' );

// Add Quick View Button to Product Loops
function premium_store_add_quick_view_button() {
	global $product;
	echo '<a href="#" class="premium-store-quick-view-btn button" data-product_id="' . esc_attr( $product->get_id() ) . '">' . esc_html__( 'Quick View', 'premium-store' ) . '</a>';
}
add_action( 'woocommerce_after_shop_loop_item', 'premium_store_add_quick_view_button', 15 );

// Ajax Handler for Quick View
function premium_store_quick_view_ajax_handler() {
	if ( ! isset( $_POST['product_id'] ) ) {
		wp_die();
	}
	$product_id = intval( $_POST['product_id'] );
	wp_reset_query();
	$args = array(
		'post_type' => 'product',
		'p' => $product_id
	);
	$query = new WP_Query( $args );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			wc_get_template_part( 'content', 'single-product' );
		}
	}
	wp_reset_query();
	wp_die();
}
add_action( 'wp_ajax_nopriv_premium_store_quick_view', 'premium_store_quick_view_ajax_handler' );
add_action( 'wp_ajax_premium_store_quick_view', 'premium_store_quick_view_ajax_handler' );
