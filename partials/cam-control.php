<?php
$projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>
<section id="cam-control">
  <div class="container">
    <div class="grid-row margin-bottom-basic">
      <div class="grid-item item-s-12 item-m-10 item-l-6 grid-column justify-center align-items-start cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?>">
        <input id="xfader" class="cam-ui cam-fader" type="range">
      </div>
      <div class="grid-item item-s-12 item-m-10 item-l-6 grid-column justify-center align-items-start cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?>">
        <input id="zoomfader" class="cam-ui cam-fader" type="range" value="0">
      </div>
    </div>
  </div>
</section>
