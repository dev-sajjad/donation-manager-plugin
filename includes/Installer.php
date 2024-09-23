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

        $charsetCollate = $wpdb->get_charset_collate();
        
        $table = $wpdb->prefix . 'fluentform_donations';

        if ($wpdb->get_var("SHOW TABLES LIKE '$table'") != $table) {
            $sql = "CREATE TABLE $table (
                `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
                `form_id` BIGINT(20) UNSIGNED NULL,
                `submission_id` BIGINT(20) UNSIGNED NULL,
                `name` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                `address` TEXT NOT NULL,
                `donation_category` VARCHAR(255) NOT NULL,
                `donation_amount` DECIMAL(10, 2) NOT NULL,
                `notes` TEXT NULL,
                `created_at` TIMESTAMP NULL,
                `updated_at` TIMESTAMP NULL,
                PRIMARY KEY (`id`)
            ) $charsetCollate;";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }
    }
}
