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

// Load scripts 
require_once(plugin_dir_path(__FILE__) . '/includes/witievents-scripts.php');