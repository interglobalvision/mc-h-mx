<?php
get_header();

$projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>

<main id="main-content">
  <div id="cam-feed-loader"></div>
  <div id="cam-feed"></div>
  <section id="posts">
    <div class="container">
      <div class="grid-row">
        <?php render_items($projects); ?>
      </div>
    </div>
  </section>

  <?php get_template_part('partials/cam-control'); ?>
</main>

<?php
get_footer();
?>
