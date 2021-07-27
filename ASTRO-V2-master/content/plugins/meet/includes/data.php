 <?php

	global $meet_db_version;
	$meet_db_version = 1.0;

	function meet_install_table()
	{
		global $wpdb;
		global $meet_db_version;

		$table_name_meet_install = $wpdb->prefix . 'entrants';

		$charset_collate = $wpdb->get_charset_collate();

		$sql_meet = "CREATE TABLE IF NOT EXISTS `$table_name_meet_install` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`entrant_id` bigint (20) UNSIGNED NOT NULL,
	`meet_id` bigint (20) UNSIGNED NOT NULL,
	`created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (entrant_id) 
	REFERENCES `wp_users` (ID),
	FOREIGN KEY (meet_id)
	REFERENCES `wp_posts` (ID)
	) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$wpdb->query($sql_meet);

		add_option('meet_db_version', $meet_db_version);
	}


	function remove_plugin_table()
	{
		global $wpdb;
		global $meet_db_version;

		$table_name_meet_install = $wpdb->prefix . 'entrants';
		$sql = "DROP TABLE IF EXISTS $table_name_meet_install;";
		$wpdb->query($sql);

		delete_option("$meet_db_version");
	}

	function my_meets_list()
	{
		global $wpdb;
		global $current_user;
		global $my_meets_id;

		$meet_list_id = $wpdb->get_results("SELECT `meet_id` FROM `wp_entrants` WHERE `entrant_id` = $current_user->ID");

		$meet_list_id_array = json_decode(json_encode($meet_list_id), true);

		$my_meets_id = array();

		foreach ($meet_list_id_array as $meet_id) {
			$my_meets_id[] = $meet_id["meet_id"];
		}
	}

// TEST UNITAIRE:
// Il ne peut y avoir qu'une seule inscription en base pour un membre et un meet (un membre ne peux pas être inscrit deux fois au même meet)
// 
 
