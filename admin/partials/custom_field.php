<?php
/* Create Custom Post Type */ 
function testimonials_post_type() {

  // set up labels
  $labels = array(
      'name' =>  __('Testimonials', 'Simple-Fading-Testimonials'),
      'singular_name' => __('Testimonials', 'Simple-Fading-Testimonials'),
      'add_new' => __('Add New Testimonial', 'Simple-Fading-Testimonials'),
      'add_new_item' => __('Add New Testimonial', 'Simple-Fading-Testimonials'),
      'edit_item' => __('Edit Testimonial', 'Simple-Fading-Testimonials'),
      'new_item' => __('New Testimonial', 'Simple-Fading-Testimonials'),
      'all_items' => __('All Testimonials', 'Simple-Fading-Testimonials'),
      'view_item' => __('View Testimonial', 'Simple-Fading-Testimonials'),
      'search_items' => __('Search Testimonials', 'Simple-Fading-Testimonials'),
      'not_found' =>  __('No Testimonials Found', 'Simple-Fading-Testimonials'),
      'not_found_in_trash' => __('No Testimonials found in Trash', 'Simple-Fading-Testimonials'),
      'parent_item_colon' => '',
      'menu_name' => __('Testimonials', 'Simple-Fading-Testimonials'),
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
    $defaults['testimonial_content'] = __('Testimonial Content', 'Simple-Fading-Testimonials');
    $defaults['word_count'] = __('Word Count', 'Simple-Fading-Testimonials');
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
        $title = _e('Enter testimonial author', 'Simple-Fading-Testimonials');
    }
    return $title;
}
add_filter( 'enter_title_here', 'wpfstop_change_default_title' );
// END edit testimonial title placeholder -----------------------------------------------