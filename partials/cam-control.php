<?php
$projects = get_post_meta($post->ID, '_igv_home_projects', true);
?>
<section id="cam-control">
  <div class="container">
    <div class="grid-row margin-bottom-basic">
      <div class="grid-item item-s-12 item-m-5 grid-column cam-control-item">
        <div class="cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?> justify-center align-items-start">
          <input id="xfader" class="cam-ui cam-fader" type="range" value="50">
        </div>
      </div>
      <div class="grid-item item-s-12 item-m-5 offset-m-1 grid-column cam-control-item">
        <div class="cam-fader-holder <?php echo empty($projects[0]['id']) ? 'hide-fader' : ''; ?> justify-center align-items-start">
          <input id="zoomfader" class="cam-ui cam-fader" type="range" value="0">
        </div>
      </div>
    </div>
  </div>
</section>
