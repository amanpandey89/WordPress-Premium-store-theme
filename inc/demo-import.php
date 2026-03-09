<?php
/**
 * One Click Demo Import Support
 */

function premium_store_import_files() {
	return array(
		array(
			'import_file_name'             => 'Premium Store Demo 1',
			'categories'                   => array( 'Fashion' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-data/demo-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-data/widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-data/customizer.dat',
			'import_preview_image_url'     => get_template_directory_uri() . '/screenshot.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'premium-store' ),
			'preview_url'                  => 'http://www.your_domain.com/my-demo-1',
		),
	);
}
add_filter( 'ocdi/import_files', 'premium_store_import_files' );

function premium_store_after_import_setup() {
	// Assign menus to their locations.
	$primary_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary' => $primary_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	if ( $front_page_id && $blog_page_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );
	}
}
add_action( 'ocdi/after_import', 'premium_store_after_import_setup' );
