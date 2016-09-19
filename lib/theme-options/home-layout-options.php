<?php
// SITE OPTIONS
$prefix = '_igv_';
$suffix = '_options';

$page_key = $prefix . 'home_layout' . $suffix;
$page_title = 'Home Layout';
$metabox = array(
  'id'         => $page_key, //id used as tab page slug, must be unique
  'title'      => $page_title,
  'show_on'    => array( 'key' => 'options-page', 'value' => array( $page_key ), ), //value must be same as id
  'show_names' => true,
  'fields'     => array(
    array(
      'id'          => $prefix . 'home_projects',
      'type'        => 'group',
      'description' => __( 'Project thumb layout on Home', 'cmb2' ),
      'options'     => array(
        'group_title'   => __( 'Project {#}', 'cmb2' ), // {#} gets replaced by row number
        'add_button'    => __( 'Add Another Project', 'cmb2' ),
        'remove_button' => __( 'Remove Project', 'cmb2' ),
        'sortable'      => true,
      ),
      'fields'     => array(
        array(
          'name'        => __( 'Project' ),
          'id'          => 'id',
          'type'        => 'post_search_text',
          'post_type'   => 'project',
          'select_type' => 'radio',
          'select_behavior' => 'replace',
        ),
        array(
          'name' => __( 'Image', 'cmb2' ),
          'id'   => 'image',
          'type' => 'file',
          'preview_size' => array(100,100),
        ),
        array(
          'name'        => __( 'Single row', 'cmb2' ),
          'description' => __( '(Centered in full-width column / Default: off)', 'cmb2' ),
          'id'          => 'single_row',
          'type'        => 'checkbox',
        ),
        array(
          'name'        => __( 'Top margin', 'cmb2' ),
          'description' => __( 'px (Default: 0)', 'cmb2' ),
          'default'     => '0',
          'id'          => 'top_margin',
          'type'        => 'text_small',
        ),
        array(
          'name'        => __( 'Side margin', 'cmb2' ),
          'description' => __( '% (Right: + / Left: - / Default: 0)', 'cmb2' ),
          'default'     => '0',
          'id'          => 'side_margin',
          'type'        => 'text_small',
        ),
        array(
          'name'        => __( 'Width', 'cmb2' ),
          'description' => __( '% (Percent width in column / Default: 100)', 'cmb2' ),
          'default'     => '100',
          'id'          => 'percent_width',
          'type'        => 'text_small',
        ),
      ),
    ),
  ),
);

IGV_init_options_page($page_key, $page_key, $page_title, $metabox);
