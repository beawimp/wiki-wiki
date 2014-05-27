/**
 * Wiki-Wiki
 * http://wordpress.org/plugins
 *
 * Copyright (c) 2014 Cole Geissinger
 * Licensed under the GPLv2+ license.
 */

( function( window, $, undefined ) {
	'use strict';

	var document       = window.document,
		wp             = window.wp,
		$add_wiki_form = $( '#wiki-wiki-add-form' ),
		$nonce         = $( '#wiki-wiki-nonce' ).val(),
		$processing    = false,
		error          = false;

	/**
	 * Ajax callback to handle our call when it successful
	 *
	 * @param data
	 */
	function wiki_add_success( data ) {

	}

	/**
	 * Ajax callback to handle our call when it fails
	 *
	 * @param data
	 */
	function wiki_add_error( data ) {

	}

	/**
	 * Event handler when our form is submitted
	 *
	 * @param event
	 */
	function wiki_add_submit( event ) {
		var form_data = {};

		event.preventDefault();

		// Make sure we aren't already processing..
		if ( false !== $processing ) {
			return false;
		}

		// Get the form data
		$( '.wiki-form-field' ).each( function( field ) {
			var $this = $( this );

			form_data[ $this.attr( 'name' ) ] = $this.val();
		});

		// Get the wp_editor content
		form_data[ 'wiki-content'] = tinyMCE.activeEditor.getContent();

		// Update the messages element we are working on submitting
		$processing = $( '#wiki-messages' ).removeClass().addClass( 'wiki-loading' ).text( 'Saving Wiki...' );

		// Save the wiki
		wp.ajax.send( 'wiki_wiki_add_wiki', {
			success: wiki_add_success,
			error: wiki_add_error,
			data: {
				nonce: $nonce,
				data: form_data
			}
		});
	}

	$add_wiki_form.on( 'submit', wiki_add_submit );

} )( this, jQuery );