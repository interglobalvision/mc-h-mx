<div class="grid-item item-s-6 project-pagination grid-row justify-start align-items-center">
  <?php 
  $left_arrow = url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/nav_left.svg');
  previous_post_link("$left_arrow %link"); ?>
</div>
<div class="grid-item item-s-6 project-pagination grid-row justify-end align-items-center">
  <?php 
  $right_arrow = url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/nav_right.svg');
  next_post_link("%link $right_arrow"); ?>
</div>