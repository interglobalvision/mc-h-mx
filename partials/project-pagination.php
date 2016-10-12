<div class="grid-item project-pagination">
  <?php 
  $left_arrow = url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/nav_left.svg');
  previous_post_link("%link", "$left_arrow %title"); ?>
</div>
<div class="grid-item project-pagination">
  <?php 
  $right_arrow = url_get_contents(get_bloginfo('stylesheet_directory') . '/img/dist/nav_right.svg');
  next_post_link("%link", "%title $right_arrow"); ?>
</div>