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
    $projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>
      <article <?php post_class('grid-row margin-top-small'); ?> id="post-<?php the_ID(); ?>">

        <div class="grid-item item-s-12 item-l-9 project-title margin-bottom-small">
          <h1 class="font-size-large"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
        </div>

        <div class="grid-item item-s-12 project-content">
          <?php
            if ($projects) {
          ?>
          <div class="project-overlay-content grid-row">
            <?php render_items($projects); ?>
          </div>
          <?php
            }

            the_content();
          ?>
        </div>

      </article>

      <div class="grid-row font-size-large margin-top-mid margin-bottom-basic justify-between">
        <?php get_template_part('partials/project-pagination'); ?>
      </div>
<?php
  }
} else {
?>
      <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
    </div>
  </section>
</main>
<?php
get_footer();
?>