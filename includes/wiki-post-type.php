<?php

/**
 * Creates the Wikis Post Type in the admin area
 *
 * @version  0.1
 * @since    0.1
 */
class Wiki_Wiki_Post_Type {
	public static function init() {
		register_post_type( 'wiki_wiki', array(
			'hierarchical'      => true,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'supports'          => array( 'title', 'editor', 'revisions', 'thumbnail', 'page-attributes' ),
			'has_archive'       => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => 'resources',
				'with_front' => false,
			),
			'labels'            => array(
				'name'               => __( 'Wikis', 'wiki_wiki' ),
				'singular_name'      => __( 'Wiki', 'wiki_wiki' ),
				'all_items'          => __( 'Wikis', 'wiki_wiki' ),
				'new_item'           => __( 'New Wiki', 'wiki_wiki' ),
				'add_new'            => __( 'Add New', 'wiki_wiki' ),
				'add_new_item'       => __( 'Add New Wiki', 'wiki_wiki' ),
				'edit_item'          => __( 'Edit Wiki', 'wiki_wiki' ),
				'view_item'          => __( 'View Wiki', 'wiki_wiki' ),
				'search_items'       => __( 'Search Wiki', 'wiki_wiki' ),
				'not_found'          => __( 'No Wikis found', 'wiki_wiki' ),
				'not_found_in_trash' => __( 'No Wikis found in trash', 'wiki_wiki' ),
				'parent_item_colon'  => __( 'Parent Wiki', 'wiki_wiki' ),
				'menu_name'          => __( 'Wikis', 'wiki_wiki' ),
			),
		) );

	}

	public static function updated_messages( $messages ) {
		global $post;

		$permalink = get_permalink( $post );

		$messages['wiki'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => sprintf( __( 'Wikis updated. <a target="_blank" href="%s">View Wikis</a>', 'wiki_wiki' ), esc_url( $permalink ) ),
			2  => __( 'Custom field updated.', 'wiki_wiki' ),
			3  => __( 'Custom field deleted.', 'wiki_wiki' ),
			4  => __( 'Wikis updated.', 'wiki_wiki' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Wikis restored to revision from %s', 'wiki_wiki' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => sprintf( __( 'Wikis published. <a href="%s">View Wikis</a>', 'wiki_wiki' ), esc_url( $permalink ) ),
			7  => __( 'Wikis saved.', 'wiki_wiki' ),
			8  => sprintf( __( 'Wikis submitted. <a target="_blank" href="%s">Preview Wikis</a>', 'wiki_wiki' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
			9  => sprintf( __( 'Wikis scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Wikis</a>', 'wiki_wiki' ),
				// translators: Publish box date format, see http://php.net/date
				date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
			10 => sprintf( __( 'Wikis draft updated. <a target="_blank" href="%s">Preview Wikis</a>', 'wiki_wiki' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		);

		return $messages;
	}

	public static function add_new_wiki() {
		wp_send_json_success( array( 'done' => 'yup' ) );
	}
}