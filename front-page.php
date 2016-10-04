<?php
get_header();

$projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>

<main id="main-content">
  <div class="cam-feed"></div>
  <section id="posts">
    <div class="container">
      <div class="grid-row">
<?php
if ($projects) {
  foreach ($projects as $project) {
    if ($project['id']) {
      $single_row = $project['single_row'];
      $top_margin = !empty($project['top_margin']) ? $project['top_margin'] . 'px' : '0';
      $side_margin = !empty($project['side_margin']) ? $project['side_margin'] . '%' : '0';
      $percent_width = !empty($project['percent_width']) ? $project['percent_width'] . '%' : '100%';
?>

    <article id="post-<?php echo $project['id']; ?>" class="home-project-item text-align-center grid-item item-s-12<?php echo $single_row != 'on' ? ' item-m-6' : false;?>">
      <div style="margin-top: <?php _e($top_margin); ?>; left: <?php _e($side_margin); ?>;">
        <a href="<?php echo get_the_permalink($project['id']) ?>">
          <?php echo wp_get_attachment_image( $project['image_id'], 'gallery', false, array('style' => 'max-width: ' . $percent_width) ); ?>
        </a>
      </div>
    </article>

<?php
    }
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/cam-control'); ?>
</main>

<?php
get_footer();
?>