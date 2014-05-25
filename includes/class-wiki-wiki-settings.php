<?php

/**
 * Adds our settings page for the wiki
 * Page is not ready yet. Converted boilerplate code to our needs, but there are some bugs that arose in the updating process.
 * @TODO: Get this working.
 *
 * @version  0.1
 * @since 	 0.1
 */

class Wiki_Wiki_Settings {

	/**
	 * Register the settings page with the wiki post type menu
	 * @return void
	 */
	public static function admin_menu() {
		add_submenu_page( 'edit.php?post_type=wiki_wiki', __( 'Wiki Settings', 'wiki_wiki' ), __( 'Settings', 'wiki_wiki' ), 'delete_pages', 'wiki-settings', array( 'Wiki_Wiki_Settings', 'settings_view' ), 100 );
	}

	/**
	 * Load the HTML output for the Settings API
	 * @return void
	 */
	public static function settings_view() {
		// Check if the user is able to access this page. Must be an admin
		if ( ! current_user_can( 'delete_pages' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'wiki_wiki' ) );
		} ?>
		<div class="wrap">

			<div id="icon-themes" class="icon32"></div>
			<h2><?php _e( 'Wiki Settings', 'wiki_wiki' ); ?></h2>
			<?php // @todo Update URL to be dynamic for easier editing ?>
			<form action="edit.php?post_type=wiki_wiki&page=wiki-settings" method="post">
				<?php settings_fields( 'cg_wikiwiki_settings' ); ?>
				<?php do_settings_sections( 'cg_wikiwiki_settings_section' ); ?>
				<?php submit_button(); ?>
			</form>

		</div>
	<?php }

	/**
	 * Define all of our settings
	 *
	 * @return void
	 */
	public static function init_settings() {
		// Add settings sections
		add_settings_section( 'wiki_wiki_config', __( 'Configuration', 'wiki_wiki' ), array( 'Wiki_Wiki_Settings', 'settings_description' ), 'cg_wikiwiki_settings_section' );

		// Add our settings fields and other magic.
		add_settings_field( 'wiki_wiki_homepage', __( 'Wiki Homepage', 'wiki_wiki' ), array( 'Wiki_Wiki_Settings', 'select_field' ), 'cg_wikiwiki_settings_section', 'wiki_wiki_config', array(
			'name' => 'homepage',
			'id'   => 'homepage',
			'options' => Wiki_Wiki_Utils::get_wiki_pages_custom( array( 'ID', 'post_title' ) ),
		) );

		// Register settings
		register_setting( 'cg_wikiwiki_settings', 'cg_wikiwiki_settings' );
	}

	/**
	 * Add a description below the section title
	 *
	 * @return void
	 */
	public static function settings_description() {
		echo '<p>' . __( 'Configure the Wiki-Wiki Settings', 'wiki_wiki' ) . '</p>';
	}

	/**
	 * Displays a text field in the settings page
	 *
	 * @param  array $args The arguments passed in the add_settings_field()
	 *
	 * @return void
	 */
	public static function text_field( $args ) {
		$values = get_option( 'wiki_wiki_settings' ); ?>
		<input type="text" name="wiki_wiki_settings[ <?php echo esc_attr( $args['name'] ); ?> ]" id="<?php echo esc_attr( $args['id'] ); ?>" value="<?php echo sanitize_text_field( $values[ $args['name'] ] ); ?>" class="regular-text">
	<?php }

	/**
	 * Displays a select field in the settings page
	 *
	 * @param  array $args The arguments passed in the add_settings_field()
	 *
	 * @return void
	 */
	public static function select_field( $args ) {
		$values = get_option( 'wiki_wiki_settings' ); ?>
		<select name="wiki_wiki_settings[<?php echo esc_attr( $args['name'] ); ?>]" id="<?php echo esc_attr( $args['id'] ); ?>">
			<option value="">Select A Homepage</option>
			<?php foreach ( $args['options'] as $key => $value ) : ?>
				<option value="<?php echo absint( $value->ID ); ?>"<?php selected( $values[ $args['name'] ], $value->ID ); ?>><?php echo esc_html( $value->post_title ); ?></option>
			<?php endforeach; ?>
		</select>
	<?php }

	/**
	 * Sanitize the data before saving
	 *
	 * @param  array $input The data set in the fields
	 *
	 * @return array $output
	 */
	public static function sanitize_input( $input ) {
		// Set our array for the sanitized options
		$output = array();

		// Loop through each of our $input options and sanitize them.
		foreach ( $input as $key => $value ) {
			$output[ $key ] = sanitize_text_field( $input[ $key ] );
		}

		return apply_filters( 'wiki_wiki_sanitize_input', $output, $input );
	}
}