<?php

/**
 * Plugin Name: WPDB Table
 * Plugin URI:
 * Description: This is a simple extension of the WordPress wpdb class providing tools to elegantly create and manage your database tables.
 * Version: 1.0
 * Author: Timothy Wood (@codearachnid)
 * Author URI: http://www.codearachnid.com
 * Author Email: tim@imaginesimplicity.com
 * Text Domain: wpdb_table
 * License: GPLv3 or later
 * 
 * Notes: THIS FILE IS FOR LOADING THE LIB & DEMO MANAGER ONLY
 * 
 * License:
 * 
 * Copyright 2011 Imagine Simplicity (tim@imaginesimplicity.com)
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * 
 * @package wpdb_table
 * @category Extension
 * @author codearachnid
 */

if ( !defined( 'ABSPATH' ) )
	die( '-1' );

/**
 *  Include required files to get this show on the road
 */
require_once 'wp-db-table.php';
require_once 'wp-db-table-demo.php';

/**
 * Add action 'plugins_loaded' to instantiate main class.
 *
 * @return void
 */
function wpdb_table() {
	if( class_exists( 'wpdb_table_demo' ) ) {
		// activate the demo	
	}
}
add_action( 'plugins_loaded', 'wpdb_table', 1 ); // high priority so that it's not too late for addon overrides
