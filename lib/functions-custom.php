<?php

// Custom functions (like special queries, etc)
function custom_view_from_studio_button($wp_admin_bar){
  $args = array(
    'id' => 'from-studio-button',
    'title' => 'View website from studio',
    'href' => get_site_url() . '?isLocal=true',
  );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_view_from_studio_button', 50);
