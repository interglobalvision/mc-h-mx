<?php
get_header();
?>

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">

        <div class="grid-item item-s-12 item-l-9 project-title margin-bottom-small">
          <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
        </div>

        <div class="grid-item item-s-12 item-l-9 project-content">
          <?php the_content(); ?>
        </div>

      </article>

      <div class="grid-row">
        <?php get_template_part('partials/project-list'); ?>
      </div>
    </div>
  </section>

</main>

<?php
  }
} else {
?>
<header id="header">
  <div class="container">
    <div class="grid-row">
      <div class="grid-item item-l-9">
        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
      </div>
      <div class="grid-item item-l-3">

      </div>
    </div>
  </div>
</header>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <article class="u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
    </div>
  </section>
</main>
<?php
} ?>

<?php
get_footer();
?>