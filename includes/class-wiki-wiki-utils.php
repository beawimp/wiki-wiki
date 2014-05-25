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

		// require_once( WIKI_WIKI_PATH . '/includes/class.wiki.php' );
	}

	/**
	 * Activate the plugin
	 */
	public static function activate() {
		// First load the init scripts in case any rewrite functionality is being loaded
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
	 * Add all scripts and styles
	 */
	public static function load_resources() {

	}

	/**
	 * Add all admin scripts and styles
	 */
	public static function load_admin_resources() {
		// Stylesheets
		wp_enqueue_style( 'wiki-wiki-admin-styles', WIKI_WIKI_URL . 'assets/css/wiki_wiki.admin.min.css', array(), '0.1.0' );

		// Scripts
		wp_enqueue_scripts( 'jquery' );
		wp_enqueue_scripts( 'wiki-wiki-admin-scripts', WIKI_WIKI_URL . 'assets/js/wiki_wiki.admin.min.js', array( 'jquery' ), '0.1.0', true );
	}

	/**
	 * [template_redirect description]
	 *
	 * @return void
	 */
	public static function template_redirect() {
		global $wp;

		// Run when we are dealing with a wiki post
		if ( isset( $wp->query_vars['post_type'] ) && 'cg_wikiwiki' === $wp->query_vars['post_type'] ) {

			// Serve the right page for the front-page of the wiki
			if ( 'resources' === $wp->request ) {
				$template_file_name = 'font-page-wiki.php';

			// Serve up the taxonomy page template
			} elseif ( isset( $wp->query_vars['cg_wikiwiki'] ) && false !== strpos( $wp->query_vars['cg_wikiwiki'], 'category' ) ) {
				$template_file_name = 'taxonomy-category.php';

			// Serve up the new wiki page screen so we can create a new wiki post
			} elseif ( isset( $wp->query_vars['name'] ) && 'new-wiki' === $wp->query_vars['name'] ) {
				$template_file_name = 'page-new-wiki.php';

			// Other wise we'll serve the singular page layout
		    } else {
		        $template_file_name = 'single-wiki.php';
		    }

		    self::do_theme_redirect( self::fetch_template( $template_file_name ) );
		}
	}

	/**
	 * Checks for and returns the file path to the template file being requested
	 *
	 * @param  string $template_name The name of the file
	 *
	 * @return string
	 */
	private static function fetch_template( $template_name ) {
		if ( file_exists( TEMPLATEPATH . '/wiki-wiki/' . $template_name ) ) {
			$template = TEMPLATEPATH . '/wiki-wiki/' . $template_name;
		} else {
			$template = WIKI_WIKI_PATH . '/templates/' . $template_name;
		}

		return $template;
	}

	/**
	 * Load our template!
	 *
	 * @param  string $url The URL to the template
	 *
	 * @return mixed
	 */
	private static function do_theme_redirect( $url ) {
		global $post, $wp_query;

		if ( have_posts() ) {
			include( $url );
			die();
		} else {
			$wp_query->is_404 = true;
		}
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


//	public static function
}