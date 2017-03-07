<div class="grid-item item-s-12 item-m-10 item-l-8 project-list">
  <ul>
<?php
$projects = get_posts('post_type=project');
$current_project_id = $post->ID;

if ($projects) {
  foreach ($projects as $project) {
?>
    <li <?php if ($project->ID === $current_project_id) {echo 'class="font-italic"';} ?>><a class="project-list-item u-inline-block" href="<?php echo get_the_permalink($project->ID); ?>"><?php echo get_the_title($project->ID); ?></a></li>
<?php
  }
}
?>
  </ul>
</div>