<?php

/**
 * Utility class to wrap generic functions
 *
 * @since  0.1.0
 */
class Wiki_Wiki_Utils {

	/**
	 * Default initialization for the plugin:
	 * - Registers the default textdomain.
	 */
	public static function init() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wiki_wiki' );
		load_textdomain( 'wiki_wiki', WP_LANG_DIR . '/wiki_wiki/wiki_wiki-' . $locale . '.mo' );
		load_plugin_textdomain( 'wiki_wiki', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

		wiki_wiki_pt_init(); // Load our CPT so the rewrite rules can be flushed on activation
	}

	/**
	 * Activate the plugin
	 */
	public static function activate() {
		self::init();

		flush_rewrite_rules();
	}

	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 */
	public static function deactivate() {

	}

	/**
	 * Add all front-end scripts and styles
	 */
	public static function load_resources() {

	}

	/**
	 * Add all admin scripts and styles
	 */
	public static function load_admin_resources() {
		// Stylesheets
		wp_enqueue_style( 'wiki-wiki-admin-styles', WIKI_WIKI_URL . 'assets/css/wiki_wiki.admin.min.css', array(), WIKI_WIKI_VERSION );

		// Scripts
		wp_enqueue_scripts( 'jquery' );
		wp_enqueue_scripts( 'wiki-wiki-admin-scripts', WIKI_WIKI_URL . 'assets/js/wiki_wiki.admin.min.js', array( 'jquery' ), WIKI_WIKI_VERSION, true );
	}

	/**
	 * Return an array of post objects
	 *
	 * @return array|bool
	 */
	public static function get_wiki_pages() {
		$args = array(
			'post_type' => 'wiki_wiki',
		);
		$wikis = new WP_Query( $args );

		return $wikis->posts;
	}

	/**
	 * Allows us to fetch wiki pages and return only certain values from the post object
	 *
	 * @param  array  $args The name of the post object keys we want to return.
	 *
	 * @return array|bool
	 */
	public static function get_wiki_pages_custom( $args = array() ) {
		$wikis = self::get_wiki_pages();

		if ( ! empty( $args ) ) {
			$wiki = array();
			$new_wikis = '';
			foreach ( $wikis as $wiki_data ) {
				foreach ( $args as $key ) {
					$wiki[ $key ] = $wiki_data->{$key};
				}
				$new_wikis[] = (object) $wiki;
			}

			return $new_wikis;
		} else {
			return false;
		}
	}

}