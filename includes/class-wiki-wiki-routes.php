<?php

class Wiki_Wiki_Routes {

	protected static $allowed_files = array(
		'home' => 'front-page-wiki',
		'category' => 'taonomy-category',
		'add-wiki' => 'page-new-wiki',
		'single' => 'single-wiki',
	);

	/**
	 * Reroutes the the templating hierarchy to pull special template layouts specifically for the wiki
	 *
	 * @return void
	 */
	public static function template_redirect() {
		global $wp;

		// Run when we are dealing with a wiki post
		if ( isset( $wp->query_vars['post_type'] ) && 'wiki_wiki' === $wp->query_vars['post_type'] ) {

			// Serve the right page for the front-page of the wiki
			if ( 'resources' === $wp->request ) {
				$template_file_name = self::$allowed_files['home'];

				// Serve up the taxonomy page template
			} elseif ( isset( $wp->query_vars['wiki-wiki'] ) && false !== strpos( $wp->query_vars['wiki-wiki'], 'category' ) ) {
				$template_file_name = self::$allowed_files['category'];

				// Serve up the new wiki page screen so we can create a new wiki post
			} elseif ( isset( $wp->query_vars['name'] ) && 'add-wiki' === $wp->query_vars['name'] ) {
				$template_file_name = self::$allowed_files['add-wiki'];

				// Other wise we'll serve the singular page layout
			} else {
				$template_file_name = self::$allowed_files['single'];
			}

			self::do_theme_redirect( self::fetch_template( $template_file_name ) );
		}
	}

	/**
	 * Checks for and returns the file path to the template file being requested
	 *
	 * @param  string $template_name The name of the file
	 *
	 * @return string|bool
	 */
	private static function fetch_template( $template_name ) {
		if ( file_exists( TEMPLATEPATH . '/wiki-wiki/' . $template_name . '.php' ) ) {
			$template_url = TEMPLATEPATH . '/wiki-wiki/' . sanitize_file_name( $template_name . '.php' );
		} else {
			$template_url = WIKI_WIKI_PATH . 'templates/' . sanitize_file_name( $template_name . '.php' );
		}

		// Prevent path traversal
		if ( false !== strpos( $template_url, '../' ) || false !== strpos( $template_url, "..\\") || false !== strpos( $template_url, '/..' ) || false !== strpos( $template_url, '\..' ) ) {
			return false;
		}

		// Double check the file actually exists
		if ( ! file_exists( $template_url ) ) {
			return false;
		}

		return $template_url;
	}

	/**
	 * Load our template!
	 *
	 * @param  string $url The URL to the template
	 *
	 * @return mixed
	 */
	private static function do_theme_redirect( $url ) {
		global $wp_query;

		if ( have_posts() ) {
			include( $url );
			die();
		} else {
			$wp_query->is_404 = true;
		}
	}
}