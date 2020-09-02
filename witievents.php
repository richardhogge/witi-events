<?php
/*
Plugin Name: WITI Events
Plugin URI: https://witi.com
Description: Upcoming events feed widget for WITI (Women in Technology International)
Version: 1.0.0
Author: Richard Hogge
Author URI: https://richardhogge.github.io/
*/

// Exit if accessed directly
if (!defined( 'ABSPATH')) {
  exit;
}

// Load Scripts
require_once(plugin_dir_path(__FILE__) . '/includes/witievents-scripts.php');

// Load Class
require_once(plugin_dir_path(__FILE__) . '/includes/witievents-class.php');

// Register Widget
function register_witievents() {
  register_widget('WITI_Events_Widget');
}

// Hook in function
add_action('widgets_init', 'register_witievents');