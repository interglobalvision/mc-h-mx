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

  // Info Page Data

  $info_meta = new_cmb2_box( array(
    'id'            => $prefix . 'info_meta',
    'title'         => __( 'Overlay Items', 'cmb2' ),
    'object_types'  => array('page',), // Post type
    'show_on'      => array( 'key' => 'id', 'value' => array( get_id_by_slug('info') ) ),
    'show_names' => true,
  ) );

  $info_meta->add_field( array(
    'name'    => __( 'Contact info', 'cmb2' ),
    'id'      => $prefix . 'contact_info',
    'type'    => 'wysiwyg',
    'options' => array( 'textarea_rows' => 6, ),
  ) );

  $info_meta->add_field( array(
    'name'    => __( 'English text content', 'cmb2' ),
    'id'      => $prefix . 'content_en',
    'type'    => 'wysiwyg',
    'options' => array( 'textarea_rows' => 15, ),
  ) );

  // Front Page Items Overlay Data

  $home_meta = new_cmb2_box( array(
    'id'            => $prefix . 'home_meta',
    'title'         => __( 'Home Layout', 'cmb2' ),
    'object_types'  => array( 'page', ), // Post type
    'show_on'      => array( 'key' => 'id', 'value' => array( get_id_by_slug('home') ) ),
  ) );

  $home_projects = $home_meta->add_field( array(
    'id'          => $prefix . 'home_projects',
    'type'        => 'group',
    'description' => __( 'Project thumb layout on Home', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Project {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Project', 'cmb2' ),
      'remove_button' => __( 'Remove Project', 'cmb2' ),
      'sortable'      => true,
    ),
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name'        => __( 'Project' ),
    'id'          => 'id',
    'type'        => 'post_search_text',
    'post_type'   => 'project',
    'select_type' => 'radio',
    'select_behavior' => 'replace',
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name' => __( 'Image', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
    'preview_size' => array(100,100),
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name'        => __( 'Single row', 'cmb2' ),
    'description' => __( '(Centered in full-width column / Default: off)', 'cmb2' ),
    'id'          => 'single_row',
    'type'        => 'checkbox',
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name'        => __( 'Top margin', 'cmb2' ),
    'description' => __( 'px (Default: 0)', 'cmb2' ),
    'default'     => '0',
    'id'          => 'top_margin',
    'type'        => 'text_small',
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name'        => __( 'Side margin', 'cmb2' ),
    'description' => __( '% (Right: + / Left: - / Default: 0)', 'cmb2' ),
    'default'     => '0',
    'id'          => 'side_margin',
    'type'        => 'text_small',
  ) );

  $home_meta->add_group_field( $home_projects, array(
    'name'        => __( 'Width', 'cmb2' ),
    'description' => __( '% (Percent width in column / Default: 100)', 'cmb2' ),
    'default'     => '100',
    'id'          => 'percent_width',
    'type'        => 'text_small',
  ) );

  // Project Single Gallery Overlay Data

  $project_meta = new_cmb2_box( array(
    'id'            => $prefix . 'project_meta',
    'title'         => __( 'Overlay Items', 'cmb2' ),
    'object_types'  => array('project',), // Post type
    'show_names' => true,
  ) );

  $project_items = $project_meta->add_field( array(
    'id'          => $prefix . 'home_projects',
    'type'        => 'group',
    'description' => __( 'Overlay items for single project', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Item {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Item', 'cmb2' ),
      'remove_button' => __( 'Remove Item', 'cmb2' ),
      'sortable'      => true,
    ),
  ) );

  $project_meta->add_group_field( $project_items, array(
    'name' => __( 'Image', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
    'preview_size' => array(100,100),
  ) );

  $project_meta->add_group_field( $project_items, array(
    'name'        => __( 'Single row', 'cmb2' ),
    'description' => __( '(Centered in full-width column / Default: off)', 'cmb2' ),
    'id'          => 'single_row',
    'type'        => 'checkbox',
  ) );

  $project_meta->add_group_field( $project_items, array(
    'name'        => __( 'Top margin', 'cmb2' ),
    'description' => __( 'px (Default: 0)', 'cmb2' ),
    'default'     => '0',
    'id'          => 'top_margin',
    'type'        => 'text_small',
  ) );

  $project_meta->add_group_field( $project_items, array(
    'name'        => __( 'Side margin', 'cmb2' ),
    'description' => __( '% (Right: + / Left: - / Default: 0)', 'cmb2' ),
    'default'     => '0',
    'id'          => 'side_margin',
    'type'        => 'text_small',
  ) );

  $project_meta->add_group_field( $project_items, array(
    'name'        => __( 'Width', 'cmb2' ),
    'description' => __( '% (Percent width in column / Default: 100)', 'cmb2' ),
    'default'     => '100',
    'id'          => 'percent_width',
    'type'        => 'text_small',
  ) );

}
?>
