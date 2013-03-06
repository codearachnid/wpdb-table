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

class wpdb_table extends wpdb {
	function create( $table, $global = false ){
		global $wpdb;
		$this->use_table( $table, $global );
	}

	function use_table( $table, $prefix = true, $blog_id = 0, $global = false ){
		global $wpdb;

		// prevent any risk of initializing the same table twice
		if( !empty($wpdb->$table) )
			return false;

		if( $global && !in_array($table, $wpdb->global_tables)){
			$wpdb->global_tables[] = $table;
			$wpdb->$table = ( $prefix ) ? $wpdb->base_prefix . $table : $table;
		} elseif (!in_array($table, $wpdb->tables)){

			if ( $prefix && ! $blog_id )
				$blog_id = $this->blogid;

			$wpdb->tables[] = $table;
			$wpdb->$table = ( $prefix ) ? $wpdb->get_blog_prefix( $blog_id ) . $table : $table;
		}
	}
	public function __construct( $dbuser, $dbpassword, $dbname, $dbhost ){
		parent::__construct( $dbuser, $dbpassword, $dbname, $dbhost );
	}
}