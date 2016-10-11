<?php
get_header();
?>

<main id="main-content">
  <section id="posts" class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $content_en = get_post_meta($post->ID, '_igv_content_en', true);
    $contact_info = get_post_meta($post->ID, '_igv_contact_info', true);
?>
      <article <?php post_class('grid-row margin-top-small margin-bottom-basic'); ?> id="post-<?php the_ID(); ?>">
        <div class="page-content grid-item item-s-12 item-m-8 active font-size-large margin-bottom-small">
          <?php the_content(); ?>
<?php 
    if (!empty($content_en)) {
?>
          <button class="lang-toggle font-size-basic">Read in English</button>
        </div>
        <div class="page-content grid-item item-s-12 item-m-8 font-size-large margin-bottom-small">
          <?php echo apply_filters('the_content', $content_en); ?>
          <button class="lang-toggle font-size-basic">Leer en español</button>
        </div>
<?php
    } else {
?>
        </div>
<?php 
    } 

    if (!empty($contact_info)) {
?>      
        <div class="grid-item item-s-12 item-m-4" id="contact-info">
          <?php echo apply_filters('the_content', $contact_info); ?>
        </div>
<?php 
    } 
?>
      </article>

      <div class="grid-row font-size-large margin-bottom-basic">
        <?php get_template_part('partials/project-list'); ?>
      </div>
<?php
  }
} else {
?>
      <article class="grid-item item-s-12 u-alert"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

    </div>
  </section>

</main>

<?php
get_footer();
?>