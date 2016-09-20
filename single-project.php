<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $images = get_post_meta($post->ID, '_igv_project_images', true);
    $english = get_post_meta($post->ID, '_igv_content_en', true);
?>

    <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">

      <div class="grid-item item-s-12 project-title">
        <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
      </div>

      <div class="grid-item item-s-12 project-content">
        <?php the_content(); ?>
      </div>

    </article>

<?php
  }
} else {
?>
    <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
      <div class="grid-row">
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
      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>