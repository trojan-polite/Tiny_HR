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










// add custom columns in admin -----------------------------------------------
add_filter('manage_edit-testimonial_columns', 'testimonials_table_head');
function testimonials_table_head( $defaults ) {
    $defaults['testimonial_content']  = 'Testimonial Content';
    $defaults['word_count']   = 'Word Count';
    return $defaults;
}


// word count function
function word_count() {
    $content = get_post_field( 'post_content', $post->ID );
    $word_count = str_word_count( strip_tags( $content ) );
    echo $word_count;
}


// assign custom columns
add_action( 'manage_testimonial_posts_custom_column', 'testimonials_table_content', 10, 2 );
function testimonials_table_content( $column_name, $post_id ) {
    if ($column_name == 'testimonial_content') {
       $testimonial_content = get_post_field( 'post_content', $post->ID );
       // echo testimonial link and content
       echo "<a href=\"". get_edit_post_link( $id, $context ). "\">$testimonial_content</a>";
    }
    if ($column_name == 'word_count') {
      word_count();
    }


}
// END add custom columns in admin -----------------------------------------------*/


// edit testimonial title placeholder
function wpfstop_change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'testimonial' == $screen->post_type ){
        $title = 'Enter testimonial author';
    }
    return $title;
}
add_filter( 'enter_title_here', 'wpfstop_change_default_title' );
// END edit testimonial title placeholder -----------------------------------------------