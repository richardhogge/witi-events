<?php

// CSS + JS
function we_add_scripts() {
  wp_enqueue_style('we-main-style', plugins_url() . '/witievents/css/style.css');
  wp_enqueue_script('we-main-script', plugins_url() . '/witievents/js/main.js');
}
add_action('wp_enqueue_scripts', 'we_add_scripts');