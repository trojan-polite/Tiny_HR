<?php 

/* Create Custom Post Type */ 
function testimonials_post_type() {

  // set up labels
  $labels = array(
    'name' => 'Testimonials',
      'singular_name' => 'Testimonials',
      'add_new' => 'Add New Testimonial',
      'add_new_item' => 'Add New Testimonial',
      'edit_item' => 'Edit Testimonial',
      'new_item' => 'New Testimonial',
      'all_items' => 'All Testimonials',
      'view_item' => 'View Testimonial',
      'search_items' => 'Search Testimonials',
      'not_found' =>  'No Testimonials Found',
      'not_found_in_trash' => 'No Testimonials found in Trash',
      'parent_item_colon' => '',
      'menu_name' => 'Testimonials',
    );

  //register post type
  register_post_type( 'Testimonial', array(
    'labels' => $labels,
    'has_archive' => false,
    'public' => false,
    'show_ui' => true,
    'supports' => array( 'title', 'editor', 'page-attributes'),
    'exclude_from_search' => false,
    'capability_type' => 'post',
    'rewrite' => array( 'slug' => 'Testimonials' ),
    'menu_icon'=> 'dashicons-format-quote',
    )
  );

}
add_action( 'init', 'testimonials_post_type' );
//add_action( 'add_meta_boxes', 'add_events_metaboxes' );
// END Create Custom Post Type -----------------------------------------------