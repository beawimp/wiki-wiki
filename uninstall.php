<?php

/**
 * Defines our uninstall features of the plugin
 * This is a complete plugin removal function. Setting uninstall to true will delete all data from the database
 */

//if uninstall not called from WordPress exit
if ( ! defined( 'cg_wikiwiki_uninstall' ) )
    exit();


// Define a list of settings we need to clear out
$uninstall_options = array();


// Delete the options
foreach ( $uninstall_options['options'] as $option ) {
	// Make sure we are only deleting what we want
	if ( in_array( $option, $uninstall_options['options'] ) )
		delete_option( $option );
}


// Delete the taxonomies and it's terms
foreach ( $uninstall_options['taxonomies'] as $tax ) {
	$terms = get_terms( $tax, array(
		'fields' => 'ids',
		'hide_empty' => false,
	) );

	// Loop through all the terms in the taxonomie and delete them
	foreach ( $terms as $term ) {
		// Make sure we are only deleting what we want
		if ( in_array( $option, $uninstall_options['taxonomies'] ) )
			wp_delete_term( $term, $tax );
	}
}
