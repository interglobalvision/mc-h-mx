<?php 
$projects = get_post_meta($post->ID, '_igv_home_projects', true); 
?>
<section id="cam-control">
  <div class="container">
    <div class="grid-row margin-bottom-small">
      <div class="grid-item item-s-7 grid-column justify-center align-items-start cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?>">
        <input class="cam-ui cam-fader" type="range">
      </div>
      <div class="grid-item item-s-5 grid-row justify-end">
        <div class="cam-buttons grid-column justify-between">
          <div class="grid-item item-s-6 no-gutter grid-row justify-between">
            <button id="cam-button-up" class="cam-ui cam-button"></button>
            <button id="cam-button-right" class="cam-ui cam-button"></button>
          </div>
          <div class="grid-item item-s-6 no-gutter grid-row justify-between align-items-end">
            <button id="cam-button-left" class="cam-ui cam-button"></button>
            <button id="cam-button-down" class="cam-ui cam-button"></button>
          </div>
        </button>
      </div>
  </div>
</section>
