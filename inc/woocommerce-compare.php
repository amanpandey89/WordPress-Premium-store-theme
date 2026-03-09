<?php
/**
 * WooCommerce Compare Functionality
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Basic implementation conceptual structure
function premium_store_add_compare_button() {
	global $product;
	echo '<button class="premium-store-compare-btn" data-product_id="' . esc_attr( $product->get_id() ) . '"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></button>';
}
add_action( 'woocommerce_after_shop_loop_item', 'premium_store_add_compare_button', 25 );
