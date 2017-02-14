<?php
// Custom functions (like special queries, etc)


// Render overlay items
function render_items($projects) {
  if ($projects) {
    $projects_length = count($projects);

    global $post;
    $context = get_post_type($post);

    foreach ($projects as $project) {
      $id = !empty($project['id']) ? $project['id'] : false;

      if (($id || $context === 'project') && $project['image']) {
        $single_row = !empty($project['single_row']) ? $project['single_row'] : false;
        $top_margin = !empty($project['top_margin']) ? $project['top_margin'] . 'px' : '0';
        $side_margin = !empty($project['side_margin']) ? $project['side_margin'] . '%' : '0';
        $percent_width = !empty($project['percent_width']) ? $project['percent_width'] . '%' : '100%';

        $stellar_scroll_speed = (rand(8, 12) / 10);
        $z_index = $projects_length * 10;
?>
      <article id="post-<?php echo $id; ?>" class="home-project-item stellar-item text-align-center grid-item item-s-12<?php echo $single_row != 'on' ? ' item-m-6' : false;?>" data-stellar-ratio="<?php echo $stellar_scroll_speed; ?>" style="z-index: <?php echo $z_index; ?>">
        <div style="margin-top: <?php _e($top_margin); ?>; left: <?php _e($side_margin); ?>;">
<?php
        if ($id) {
?>
          <a href="<?php echo get_the_permalink($id) ?>">
<?php
        }
          $check_filetype = wp_check_filetype($project['image']);

          if ($check_filetype['ext'] == 'gif') {
            $img_elem = '<img src="' . $project['image'] . '" style="max-width: ' . $percent_width . '">';
          } else {
            $img_elem = wp_get_attachment_image( $project['image_id'], 'gallery', false, array('style' => 'max-width: ' . $percent_width) );
          }
          echo $img_elem;
        if ($id) {
?>
          </a>
<?php
        }
?>
        </div>
      </article>
<?php
      $projects_length--;
      }
    }
  }
}

// Show special admin link for internet viewing of website
function custom_view_from_studio_button($wp_admin_bar){
  $args = array(
    'id' => 'from-studio-button',
    'title' => 'View website from studio',
    'href' => get_site_url() . '?isLocal=true',
  );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_view_from_studio_button', 50);
