<?php
remove_shortcode('gallery', 'gallery_shortcode');
function my_gallery_shortcode($attr) {
  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
    // 'ids' is explicitly ordered, unless you specify otherwise.
    if ( empty( $attr['orderby'] ) ) {
      $attr['orderby'] = 'post__in';
    }
    $attr['include'] = $attr['ids'];
  }

  /**
   * Filters the default gallery shortcode output.
   *
   * If the filtered output isn't empty, it will be used instead of generating
   * the default gallery template.
   *
   * @since 2.5.0
   * @since 4.2.0 The `$instance` parameter was added.
   *
   * @see gallery_shortcode()
   *
   * @param string $output   The gallery output. Default empty.
   * @param array  $attr     Attributes of the gallery shortcode.
   * @param int    $instance Unique numeric ID of this gallery shortcode instance.
   */
  $output = apply_filters( 'post_gallery', '', $attr, $instance );
  if ( $output != '' ) {
    return $output;
  }

  $atts = shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post ? $post->ID : 0,
    'include'    => '',
    'exclude'    => '',
  ), $attr, 'gallery' );

  $id = intval( $atts['id'] );

  $captiontag = tag_escape( $atts['captiontag'] );

  $selector = "gallery-{$instance}";

  $gallery_div = "<div id='$selector' class='gallery galleryid-{$id}'>";

  $output = $gallery_div;

  if ( ! empty( $atts['include'] ) ) {
    $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

    $attachments = array();
    foreach ( $_attachments as $key => $val ) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  } elseif ( ! empty( $atts['exclude'] ) ) {
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  } else {
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
  }

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {

    $image_meta  = wp_get_attachment_metadata( $id );

    $orientation = '';
    if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
      $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
    }

    $image_output = wp_get_attachment_image( $id, 'item-l-9-16x9', false, $attr );

    $output .= "
      <div class='gallery-image-holder {$orientation}'>
        $image_output
      </div>";

    if ( $captiontag && trim($attachment->post_excerpt) ) {
      $output .= "
        <figcaption class='wp-caption-text gallery-caption' id='$selector-$id'>
        " . wptexturize($attachment->post_excerpt) . "
        </figcaption>";
    }

  }

  $output .= "
    </div>\n";

  return $output;
}
add_shortcode('gallery', 'my_gallery_shortcode');