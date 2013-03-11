WordPress Class: wpdb_table
==========

This is a simple way to manage tables used in the global $wpdb object. Elegantly create and manage your custom database tables. It creatively injects the table into the $wpdb object so you can use custom tables just like defaults.

### Usage
See the demo in plugin-wrapper.php. The global $wpdb_table variable is available to use the "create" method to execute the SQL to create the table.
```
global $wpdb_table;
$wpdb_table->create('table_demo', 'id mediumint(9) NOT NULL AUTO_INCREMENT,
									   time datetime DEFAULT "0000-00-00 00:00:00" NOT NULL,
									   UNIQUE KEY id (id)' );
```

If the table already exists (since you've hooked into your plugin activation to create), use the "inject_table" method to inject the custom table properties into the $wpdb object so that you can then use it within your $wpdb queries like defaults.