<?php

/**
 * Plugin Name: Donation Manager Plugin
 * Description: A plugin to manage donations under Fluent Forms.
 * Version: 1.0.0
 * Author: dev-sajjad
 * Author URI: https://github.com/dev-sajjad
 * Text Domain: donation-manager
 * License: GPLv2 or later
 */

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/autoload.php';


final class Donation_Manager
{
    /**
     * Plugin version.
     * 
     * @var string
     */
    const version = '1.0.0';


    /**
     * Class constructor.
     */
    public function __construct()
    {

        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('init', array($this, 'init_plugin'));
    }

    public static function init()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new self();
        }

        return $instance;
    }


    /**
     * Defines the required plugin constants.
     * 
     * @return void
     */

    public function define_constants()
    {
        define('DONATION_MANAGER_VERSION', self::version);
        define('DONATION_MANAGER_FILE', __FILE__);
        define('DONATION_MANAGER_PATH', __DIR__);
        define('DONATION_MANAGER_URL', plugins_url('', DONATION_MANAGER_FILE));
    }

    /**
     * Initialize the plugin.
     * 
     * @return void
     */

    public function init_plugin()
    {
        add_action('admin_menu', array($this, 'add_menu'));

        // Check if Fluent Forms Pro is active and show admin notice if not
        if (!defined('FLUENTFORMPRO')) {
            add_action('admin_notices', array($this, 'show_admin_error_notice'));
        }
    }

    /**
     * Show an admin error notice if Fluent Forms Pro is not active.
     * 
     * @return void
     */
    public function show_admin_error_notice()
    {
        $class = 'notice notice-error';
        $message = __('Donation Manager Plugin requires Fluent Forms Pro Add On Pack to be installed and active.', 'donation-manager');

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
    }


    /**
     * Add a submenu under Fluent Forms for Donations.
     * 
     * @return void
     */

    public function add_menu()
    {
        // Ensure Fluent Forms Pro is active
        if (!defined('FLUENTFORMPRO')) {
            return;
        }

        add_submenu_page(
            'fluent_forms',
            __('Donations', 'fluentform'),
            __('Donations', 'fluentform'),
            'fluentform_forms_manager',
            'donation_manager',
            array($this, 'render_page')
        );
    }

    public function activate()
    {
        // Run the installer to add table in the database
        $installer = new FluentForm\DonationManager\Installer();
        $installer->run();
    }

    /**
     * Callback function to display the content when "Donations" is clicked.
     * 
     * @return void
     */

    public function render_page()
    {
        echo '<div id="donation-app"></div>'; // Vue.js mount point
    }
}

function donation_manager()
{
    return Donation_Manager::init();
}

donation_manager();
