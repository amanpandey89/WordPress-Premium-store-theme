<?php
/**
 * Advanced Theme Admin Dashboard
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// 1. Register the Menu Page
function premium_store_add_admin_menu() {
	add_theme_page(
		__( 'Premium Store', 'premium-store' ), 
		__( 'Premium Store', 'premium-store' ),          
		'manage_options',                                
		'premium-store-admin',                           
		'premium_store_admin_page_html'                  
	);
	
	// Register settings so they can be saved automatically by the Settings API
	add_action( 'admin_init', 'premium_store_register_settings' );
}
add_action( 'admin_menu', 'premium_store_add_admin_menu' );

// 2. Register Settings Array
function premium_store_register_settings() {
	register_setting( 'premium_store_options_group', 'premium_store_settings' );
}

// 3. Render the Dashboard Page
function premium_store_admin_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Handle current tab routing
	$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'brand';
	
	// Get current options
	$options = get_option( 'premium_store_settings', array() );
	
	// Default values
	$logo_url    = isset( $options['logo_url'] ) ? esc_url( $options['logo_url'] ) : '';
	$header_code = isset( $options['header_code'] ) ? wp_unslash( $options['header_code'] ) : '';
	$footer_code = isset( $options['footer_code'] ) ? wp_unslash( $options['footer_code'] ) : '';
	?>
	<div class="wrap premium-store-admin-wrap" style="background:#f0f0f1; margin: -10px -20px 0; padding: 20px;">
		<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
			<h1 style="margin: 0; font-size: 24px; font-weight: 600;">
				<span style="background: #111; color: #fff; padding: 4px 8px; border-radius: 4px; font-size: 14px; vertical-align: middle; margin-right: 10px;">PS</span> 
				<?php esc_html_e( 'Premium Store Dashboard', 'premium-store' ); ?>
			</h1>
		</div>
		
		<div style="display: flex; gap: 30px;">
			<!-- Sidebar Main Nav -->
			<div style="width: 200px; flex-shrink: 0;">
				<ul style="list-style: none; padding: 0; margin: 0;">
					<li style="margin-bottom: 5px;"><a href="?page=premium-store-admin" style="display: block; padding: 10px 15px; text-decoration: none; color: <?php echo ( $active_tab !== 'started' ) ? '#111' : '#2271b1'; ?>; font-weight: 500; background: <?php echo ( $active_tab !== 'started' ) ? 'transparent' : '#fff'; ?>; border-radius: 4px;"><?php esc_html_e( 'Theme Settings', 'premium-store' ); ?></a></li>
					<li style="margin-bottom: 5px;"><a href="<?php echo esc_url( admin_url( 'site-editor.php' ) ); ?>" style="display: block; padding: 10px 15px; text-decoration: none; color: #50575e;"><?php esc_html_e( 'Full Site Editor', 'premium-store' ); ?> <span class="dashicons dashicons-external" style="font-size: 14px; margin-top:2px;"></span></a></li>
				</ul>
			</div>

			<!-- Main Content Panel -->
			<div style="flex-grow: 1; background: #fff; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); overflow: hidden;">
				
				<!-- Top Tabs -->
				<div style="border-bottom: 1px solid #e2e4e7; padding: 0 20px;">
					<h2 class="nav-tab-wrapper" style="border-bottom: none; margin: 0; padding-top: 15px;">
						<a href="?page=premium-store-admin&tab=brand" class="nav-tab <?php echo $active_tab === 'brand' ? 'nav-tab-active' : ''; ?>" style="margin-right: 10px;"><?php esc_html_e( 'Brand Settings', 'premium-store' ); ?></a>
						<a href="?page=premium-store-admin&tab=scripts" class="nav-tab <?php echo $active_tab === 'scripts' ? 'nav-tab-active' : ''; ?>" style="margin-right: 10px;"><?php esc_html_e( 'Custom Scripts', 'premium-store' ); ?></a>
						<a href="?page=premium-store-admin&tab=performance" class="nav-tab <?php echo $active_tab === 'performance' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Performance', 'premium-store' ); ?></a>
					</h2>
				</div>

				<!-- Settings Form -->
				<div style="padding: 30px;">
					<form method="post" action="options.php">
						<?php 
						settings_fields( 'premium_store_options_group' ); 
						
						// TAB: BRAND SETTINGS
						if ( $active_tab === 'brand' ) : ?>
							<h3 style="margin-top: 0;"><?php esc_html_e( 'Brand Configuration', 'premium-store' ); ?></h3>
							<div style="background: #fff8e5; border-left: 4px solid #f5c344; padding: 12px 15px; margin-bottom: 20px;">
								<p style="margin: 0;"><?php esc_html_e( 'Tip: Because this is a Full Site Editing theme, settings here inject globals that templates can use. For deep layout changes, use the Site Editor.', 'premium-store' ); ?></p>
							</div>
							
							<table class="form-table" role="presentation">
								<tr>
									<th scope="row"><label for="logo_url"><?php esc_html_e( 'Fallback Logo URL', 'premium-store' ); ?></label></th>
									<td>
										<input type="text" id="logo_url" name="premium_store_settings[logo_url]" value="<?php echo esc_attr( $logo_url ); ?>" class="regular-text" placeholder="https://example.com/logo.png" />
										<p class="description"><?php esc_html_e( 'Used if the Site Title block is not populated in FSE.', 'premium-store' ); ?></p>
									</td>
								</tr>
							</table>

						<?php 
						// TAB: SCRIPTS
						elseif ( $active_tab === 'scripts' ) : ?>
							<h3 style="margin-top: 0;"><?php esc_html_e( 'Header & Footer Scripts', 'premium-store' ); ?></h3>
							<table class="form-table" role="presentation">
								<tr>
									<th scope="row"><label for="header_code"><?php esc_html_e( 'Header Code (<head>)', 'premium-store' ); ?></label></th>
									<td>
										<textarea id="header_code" name="premium_store_settings[header_code]" rows="5" class="large-text code" placeholder="<!-- Tracking code here -->"><?php echo esc_textarea( $header_code ); ?></textarea>
										<p class="description"><?php esc_html_e( 'Add code like Google Analytics or Meta Pixel.', 'premium-store' ); ?></p>
									</td>
								</tr>
								<tr>
									<th scope="row"><label for="footer_code"><?php esc_html_e( 'Footer Code (</body>)', 'premium-store' ); ?></label></th>
									<td>
										<textarea id="footer_code" name="premium_store_settings[footer_code]" rows="5" class="large-text code"><?php echo esc_textarea( $footer_code ); ?></textarea>
										<p class="description"><?php esc_html_e( 'Add scripts that should load at the very end of the page.', 'premium-store' ); ?></p>
									</td>
								</tr>
							</table>
						
						<?php 
						// TAB: PERFORMANCE
						elseif ( $active_tab === 'performance' ) : ?>
							<h3 style="margin-top: 0;"><?php esc_html_e( 'Performance Optimizations', 'premium-store' ); ?></h3>
							<table class="form-table" role="presentation">
								<tr>
									<th scope="row"><?php esc_html_e( 'Gutenberg CSS', 'premium-store' ); ?></th>
									<td>
										<label>
											<input type="checkbox" name="premium_store_settings[disable_gutenberg_css]" value="1" <?php checked( isset( $options['disable_gutenberg_css'] ) && $options['disable_gutenberg_css'] == '1' ); ?> />
											<?php esc_html_e( 'Disable default block library CSS (Advanced)', 'premium-store' ); ?>
										</label>
									</td>
								</tr>
							</table>
						<?php endif; ?>

						<!-- Save Button -->
						<div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e4e7;">
							<?php submit_button( __( 'Save Changes', 'premium-store' ), 'primary', 'submit', false ); ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
}

// 4. Implement Saved Theme Options Frontend Hooks
function premium_store_apply_custom_scripts() {
	$options = get_option( 'premium_store_settings', array() );
	
	if ( ! empty( $options['header_code'] ) ) {
		add_action( 'wp_head', function() use ( $options ) {
			echo wp_unslash( $options['header_code'] ) . "\n";
		}, 99 );
	}
	
	if ( ! empty( $options['footer_code'] ) ) {
		add_action( 'wp_footer', function() use ( $options ) {
			echo wp_unslash( $options['footer_code'] ) . "\n";
		}, 99 );
	}
}
add_action( 'init', 'premium_store_apply_custom_scripts' );
