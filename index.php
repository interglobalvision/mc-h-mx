<?php
get_header();
?>

<main id="main-content">
  <section id="posts" class="container">
    <div class="grid-row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
      <article <?php post_class('grid-item item-s-12'); ?> id="post-<?php the_ID(); ?>">
        <a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a>
      </article>
<?php
  }
} else {
?>
      <article class="grid-item item-s-12 u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>
      <?php get_template_part('partials/pagination'); ?>

    </div>
  </section>

</main>

<?php
get_footer();
?>