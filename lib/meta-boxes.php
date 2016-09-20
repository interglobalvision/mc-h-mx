<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $i18n_meta = new_cmb2_box( array(
    'id'            => $prefix . 'i18n_meta',
    'title'         => __( 'English', 'cmb2' ),
    'object_types'  => array('page', 'project', 'post',), // Post type
    'show_names' => false,
  ) );

  $i18n_meta->add_field( array(
    'name'    => __( 'English text content', 'cmb2' ),
    'id'      => $prefix . 'content_en',
    'type'    => 'wysiwyg',
    'options' => array( 'textarea_rows' => 15, ),
  ) );

  $project_meta = new_cmb2_box( array(
    'id'            => $prefix . 'project_meta',
    'title'         => __( 'Project', 'cmb2' ),
    'object_types'  => array('project',), // Post type
    'show_names' => false,
  ) );

  
}
?>
