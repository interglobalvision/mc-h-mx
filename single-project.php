<?php
get_header();
?>

<main id="main-content">
  <a class="project-close" href="<?php echo home_url(); ?>">X</a>
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

      <div class="grid-item item-s-12 item-l-9 project-title margin-bottom-small">
        <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
      </div>

      <div class="grid-item item-s-12 item-l-9 project-content">
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
        <?php get_template_part('partials/project-list'); ?>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>