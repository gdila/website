<?php

/*-----------------------------------------------------------------------------------------------------//
/*	Theme License and Updater
/*-----------------------------------------------------------------------------------------------------*/

// Includes the files needed for the theme updater
if ( !class_exists( 'EDD_Theme_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new EDD_Theme_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://organicthemes.com', // Site where EDD is hosted
		'item_name' => 'Collective Theme + Support & Updates Subscription', // Name of theme
		'theme_slug' => 'collective', // Theme slug
		'version' => '2.1.1', // The current version of this theme
		'author' => 'Organic Themes', // The author of this theme
		'download_id' => '168400', // Optional, used for generating a license renewal link
		'renew_url' => '' // Optional, allows for a custom license renewal link
	),

	// Strings
	$strings = array(
		'theme-license' => __( 'Theme License', 'collective' ),
		'enter-key' => __( 'Enter your theme license key.', 'collective' ),
		'license-key' => __( 'License Key', 'collective' ),
		'license-action' => __( 'License Action', 'collective' ),
		'deactivate-license' => __( 'Deactivate License', 'collective' ),
		'activate-license' => __( 'Activate License', 'collective' ),
		'status-unknown' => __( 'License status is unknown.', 'collective' ),
		'renew' => __( 'Renew?', 'collective' ),
		'unlimited' => __( 'unlimited', 'collective' ),
		'license-key-is-active' => __( 'License key is active.', 'collective' ),
		'expires%s' => __( 'Expires %s.', 'collective' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'collective' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'collective' ),
		'license-key-expired' => __( 'License key has expired.', 'collective' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'collective' ),
		'license-is-inactive' => __( 'License is inactive.', 'collective' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'collective' ),
		'site-is-inactive' => __( 'Site is inactive.', 'collective' ),
		'license-status-unknown' => __( 'License status is unknown.', 'collective' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'collective' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'collective' )
	)

);