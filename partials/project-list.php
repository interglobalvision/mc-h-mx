<div class="grid-item item-s-12 item-m-10 item-l-8 project-list">
  <ul>
<?php 
$projects = get_posts('post_type=project');

if ($projects) {
  foreach ($projects as $project) {
?>
    <li><a href="<?php echo get_the_permalink($project->ID); ?>"><?php echo get_the_title($project->ID); ?></a></li>
<?php
  }
}
?>
  </ul>
</div>