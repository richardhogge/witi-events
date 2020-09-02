<?php
/**
 * Adds CSS and JS
 */
function witi_styles_and_scripts() {
  wp_enqueue_style('witi-style', plugins_url() . '/witievents/css/style.css');
  wp_enqueue_script('witi-script', plugins_url() . '/witievents/js/main.js');
}
add_action('wp_enqueue_scripts', 'witi_styles_and_scripts');