<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme License and Updater
/*-----------------------------------------------------------------------------------------------------*/

define( 'OT_SL_STORE_URL', 'http://organicthemes.com' );
define( 'OT_SL_COLLECTIVE_THEME', 'Collective Theme' );

if( !class_exists( 'EDD_SL_Theme_Updater' ) ) {
	// Load theme updater
	include( dirname( __FILE__ ) . '/EDD_SL_Theme_Updater.php' );
}

function collective_theme_sl_updater() {

	// Retrieve our license key from the DB
	$license = trim( get_option( 'collective_license_key' ) );

	// Setup the updater
	$edd_updater = new EDD_SL_Theme_Updater( array( 
			'remote_api_url'=> OT_SL_STORE_URL, 	// our store URL that is running EDD
			'version' 		=> '2.0.6', 	        // the current theme version we are running
			'license' 		=> $license,			// the license key (used get_option above to retrieve from DB)
			'item_name' 	=> OT_SL_COLLECTIVE_THEME,	// the name of this theme
			'author'		=> 'Organic Themes'		// the author's name
		)
	);
}
add_action( 'admin_init', 'collective_theme_sl_updater' );

function collective_theme_license_menu() {
	add_theme_page( 'Theme License', 'Theme License', 'manage_options', 'collective-license', 'collective_theme_license_page' );
}
add_action('admin_menu', 'collective_theme_license_menu');

function collective_theme_license_page() {
	$license 	= get_option( 'collective_license_key' );
	$status 	= get_option( 'collective_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Theme License Options', 'organicthemes'); ?></h2>
		<form method="post" action="options.php">
		
			<?php settings_fields('collective_theme_license'); ?>
			
			<table class="form-table">
				<tbody>
					<tr valign="top">	
						<th scope="row" valign="top">
							<?php _e('License Key', 'organicthemes'); ?>
						</th>
						<td>
							<input id="collective_license_key" name="collective_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
							<label class="description" for="collective_license_key"><?php _e('Enter your license key', 'organicthemes'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">	
							<th scope="row" valign="top">
								<?php _e('Activate License', 'organicthemes'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green; line-height:2;margin-right:12px;"><?php _e('Active', 'organicthemes'); ?></span>
									<?php wp_nonce_field( 'organic_nonce', 'organic_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_deactivate" value="<?php _e('Deactivate License', 'organicthemes'); ?>"/>
								<?php } else {
									wp_nonce_field( 'organic_nonce', 'organic_nonce' ); ?>
									<input type="submit" class="button-secondary" name="edd_theme_license_activate" value="<?php _e('Activate License', 'organicthemes'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
			<?php submit_button(); ?>
		
		</form>
	<?php
}

function collective_theme_register_option() {
	// creates our settings in the options table
	register_setting('collective_theme_license', 'collective_license_key', 'collective_theme_sanitize_license' );
}
add_action('admin_init', 'collective_theme_register_option');

function collective_theme_sanitize_license( $new ) {
	$old = get_option( 'collective_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'collective_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function collective_theme_activate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_activate'] ) ) {

		// run a quick security check 
	 	if( ! check_admin_referer( 'organic_nonce', 'organic_nonce' ) ) 	
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'collective_license_key' ) );	

		// data to send in our API request
		$api_params = array( 
			'edd_action'=> 'activate_license', 
			'license' 	=> $license, 
			'item_name' => urlencode( OT_SL_COLLECTIVE_THEME )
		);
		
		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		
		// $license_data->license will be either "active" or "inactive"

		update_option( 'collective_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'collective_theme_activate_license');

function collective_theme_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['edd_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'organic_nonce', 'organic_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'collective_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( OT_SL_COLLECTIVE_THEME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'collective_license_key_status' );

	}
}
add_action('admin_init', 'collective_theme_deactivate_license');

function collective_theme_check_license() {

	global $wp_version;

	$license = trim( get_option( 'collective_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( OT_SL_COLLECTIVE_THEME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, OT_SL_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}