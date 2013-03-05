<?php
/**
 * WordPress DB Table Class
 *
 * @package wpdb_table
 * @category Extension
 * @author codearachnid
 */


if ( !defined( 'ABSPATH' ) )
	die( '-1' );

// this plugin requires that wpdb_table exist prior to loading
if( class_exists( 'wpdb_table' ) ) {
	class wpdb_table_demo {
	}
}