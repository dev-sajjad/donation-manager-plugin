<?php

namespace FluentForm\DonationManager;

class Installer
{
    /**
     * Migrate the table.
     *
     * @return void
     */
    public function run()
    {
        global $wpdb;

        // Get the charset and collation for the table
        $charsetCollate = $wpdb->get_charset_collate();

        // Set the table name
        $table = $wpdb->prefix . 'fluentform_donations';

        // Check if the table already exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {

            // SQL statement to create the table
            $sql = "CREATE TABLE $table (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                `address` TEXT NULL,
                `donation_amount` DECIMAL(10, 2) NOT NULL,
                `donation_category` VARCHAR(100) NULL,
                `notes` TEXT NULL,
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL,
                PRIMARY KEY (`id`)
            ) $charsetCollate;";

            // Include the WordPress dbDelta function to handle table creation
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';

            // Execute the query
            dbDelta($sql);
        }
    }
}
