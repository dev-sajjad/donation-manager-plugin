<?php
defined('ABSPATH') or die;

spl_autoload_register(function ($class) {
    $namespace = 'FluentForm\\DonationManager\\';

    // Ensure the class is within the correct namespace
    if (strpos($class, $namespace) !== 0) {
        return;
    }

    // Remove the base namespace from the class
    $className = str_replace($namespace, '', $class);

    // Replace namespace separators with directory separators
    $className = str_replace('\\', '/', $className);

    // Build the file path relative to the "includes" directory
    $file = plugin_dir_path(__FILE__) . 'includes/' . $className . '.php';

    // Check if the file exists and include it
    if (is_readable($file)) {
        include $file;
    }
});
 