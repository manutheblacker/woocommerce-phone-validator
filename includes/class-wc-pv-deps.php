<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class WC_PV_Dependencies {
	private static $active_plugins;

	public static function init() {
		self::$active_plugins = (array) get_option( 'active_plugins', array() );
		if ( is_multisite() ) {
			self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
		}
	}

	/**
	 * Check if woocommerce exist
	 *
	 * @return Boolean
	 */
	public static function woocommerce_active_check() {
		if ( ! self::$active_plugins ) {
			self::init();
		}
		return in_array( 'woocommerce/woocommerce.php', self::$active_plugins ) || array_key_exists( 'woocommerce/woocommerce.php', self::$active_plugins );
	}

	/**
	 * Check if woocommerce is active
	 *
	 * @return Boolean
	 */
	public static function is_woocommerce_active() {
		return self::woocommerce_active_check();
	}
}
