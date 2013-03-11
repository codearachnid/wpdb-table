<?php
/**
 * WordPress DB Table Class
 *
 * Original code/concept from {@link http://codex.wordpress.org/Creating_Tables_with_Plugins WordPress Codex}
 *
 * @package wpdb_table
 * @category Extension
 * @author codearachnid
 */


if ( !defined( 'ABSPATH' ) )
	die( '-1' );

class wpdb_table {

	private $addon_tables = array();
	
	public function __construct(){
		global $wpdb;
		$wpdb->addon_tables = array();
	}

	public function create( $table, $fields = null, $prefix = true, $global = false ){
		global $wpdb;

		if( !function_exists('dbDelta') )
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		if( !empty($fields) && $table_name = $this->inject_table( $table, $prefix, $global ) ) {

			// last chance check to make sure we haven't created it before
			if( $this->table_exists( $table ) )
				return false;

			$sql = sprintf( 'CREATE TABLE %s (%s);',
				$table_name,
				is_array($fields) ? implode( ',', $fields ) : $fields
				);
			dbDelta( $sql );
			return $table_name;
		}

		return false;
	}

	function table_exists( $table ){
		global $wpdb;
		$table_check = $wpdb->get_results( sprintf("SHOW TABLES LIKE '%s';", $table ), ARRAY_N );
		return !empty( $table_check ) ? true : false;
	}

	public function inject_table( $table, $prefix = true, $global = false ){
		global $wpdb;

		// prevent the risk of initializing the same table twice
		if( !empty($wpdb->$table) )
			return false;

		// let's make it easier to cache created tables
		$wpdb->addon_tables[] = $table;

		if( $global && !in_array($table, $wpdb->global_tables)){
			$prefix_table = ( $prefix ) ? $wpdb->base_prefix . $table : $table;
			$wpdb->global_tables[] = $table;
		} elseif (!in_array($table, $wpdb->tables)){

			$prefix_table = ( $prefix ) ? $wpdb->get_blog_prefix() . $table : $table;
			$wpdb->tables[] = $table;
		}

		if( !empty($prefix_table) ){
			$wpdb->$table = $prefix_table;
			return $prefix_table;
		} else {
			return false;
		}
	}
}
$wpdb_table = new wpdb_table();