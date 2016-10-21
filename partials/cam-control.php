<?php
$projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>
<section id="cam-control">
  <div class="container">
    <div class="grid-row margin-bottom-basic">
      <div class="grid-item item-s-12 item-m-10 offset-m-1 item-l-8 offset-l-2 grid-column justify-center align-items-start cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?>">
        <input class="cam-ui cam-fader" type="range">
      </div>
    </div>
  </div>
</section>
