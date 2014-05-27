<?php
/**
 * Plugin Name: Wiki-Wiki
 * Plugin URI:  http://wordpress.org/plugins/wiki-wiki
 * Description: This plugin has come to out of the frustration I've had with existing wiki plugins for WordPress.
 * Version:     0.1.0
 * Author:      Cole Geissinger
 * Author URI:  http://www.colegeissinger.com
 * License:     GPLv2+
 * Text Domain: wiki_wiki
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Cole Geissinger (email : cole@colegeissinger.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

// Set the constants
define( 'WIKI_WIKI_VERSION', '0.1.0' );
define( 'WIKI_WIKI_URL',     plugin_dir_url( __FILE__ ) );
define( 'WIKI_WIKI_PATH',    dirname( __FILE__ ) . '/' );

// Load includes
require_once WIKI_WIKI_PATH . 'includes/wiki-post-type.php';
require_once WIKI_WIKI_PATH . 'includes/categories-taxonomy.php';
require_once WIKI_WIKI_PATH . 'includes/class-wiki-wiki-utils.php';
require_once WIKI_WIKI_PATH . 'includes/class-wiki-wiki-settings.php';
require_once WIKI_WIKI_PATH . 'includes/class-wiki-wiki-routes.php';

// Wireup actions
register_activation_hook(   __FILE__, array( 'Wiki_Wiki_Utils', 'activate'   ) );
register_deactivation_hook( __FILE__, array( 'Wiki_Wiki_Utils', 'deactivate' ) );

add_action( 'init', array( 'Wiki_Wiki_Utils', 'init' ) );
add_action( 'init', array( 'Wiki_wiki_Post_Type', 'init' ) );
add_action( 'wp_ajax_wiki_wiki_add_wiki', array( 'Wiki_Wiki_Post_Type', 'add_new_wiki' ) );

// Front-end Actions
if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', array( 'Wiki_Wiki_Utils', 'load_resources' ) );
	add_action( 'template_redirect', array( 'Wiki_Wiki_Routes', 'template_redirect' ) );
}

// Admin Actions
if ( is_admin() ) {
	add_action( 'admin_enqueue_scripts', array( 'Wiki_Wiki_Utils', 'load_admin_resources' ) );
	add_action( 'admin_menu', array( 'Wiki_Wiki_Settings', 'admin_menu' ) );
	add_action( 'admin_init', array( 'Wiki_Wiki_Settings', 'init_settings' ) );
}

// Wireup filters
add_filter( 'post_updated_messages', array( 'Wiki_Wiki_Post_Type', 'updated_messages' ) );

// Wireup shortcodes
