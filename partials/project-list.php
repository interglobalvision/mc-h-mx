<div class="grid-item item-s-12 item-m-10 item-l-8 project-list margin-top-small">
  <ul>
<?php 
$projects = get_posts('post_type=project');

if ($projects) {
  foreach ($projects as $project) {
?>
    <li class="font-size-h1"><a href="<?php echo get_the_permalink($project->ID); ?>"><?php echo get_the_title($project->ID); ?></a></li>
<?php
  }
}
?>
  </ul>
</div>