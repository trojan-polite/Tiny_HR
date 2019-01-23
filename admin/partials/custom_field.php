<?php
/* Create Custom Post Type */ 
function testimonials_post_type() {


  // set up labels
  $labels = array(
      'name' =>  __('Testimonials', 'simple-fading-testimonials-widget'),
      'singular_name' => __('Testimonials', 'simple-fading-testimonials-widget'),
      'add_new' => __('Add New Testimonial', 'simple-fading-testimonials-widget'),
      'add_new_item' => __('Add New Testimonial', 'simple-fading-testimonials-widget'),
      'edit_item' => __('Edit Testimonial', 'simple-fading-testimonials-widget'),
      'new_item' => __('New Testimonial', 'simple-fading-testimonials-widget'),
      'all_items' => __('All Testimonials', 'simple-fading-testimonials-widget'),
      'view_item' => __('View Testimonial', 'simple-fading-testimonials-widget'),
      'search_items' => __('Search Testimonials', 'simple-fading-testimonials-widget'),
      'not_found' =>  __('No Testimonials Found', 'simple-fading-testimonials-widget'),
      'not_found_in_trash' => __('No Testimonials found in Trash', 'simple-fading-testimonials-widget'),
      'parent_item_colon' => '',
      'menu_name' => __('Testimonials', 'simple-fading-testimonials-widget'),
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
    $defaults['testimonial_content'] = __('Testimonial Content', 'simple-fading-testimonials-widget');
    $defaults['word_count'] = __('Word Count', 'simple-fading-testimonials-widget');
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
    if ( 'testimonial' == $screen->post_type ){
        $title = _e('Enter testimonial author', 'simple-fading-testimonials-widget');
    }
    return $title;
}
add_filter( 'enter_title_here', 'wpfstop_change_default_title' );
// END edit testimonial title placeholder -----------------------------------------------



//  add admin credits
function my_custom_admin_credits( $footer_text ) {
    $current_screen = get_current_screen();
    if( $current_screen->post_type === "testimonial" ) {

		$footer_text = __( 'Thank you for using <a href="https://en-gb.wordpress.org/plugins/simple-fading-testimonials-widget/" target="_blank">Simple Fading Testimonials </a> by <a href="https://www.stephenkempin.co.uk/" target="_blank">Stephen Kempin</a>' );
	}
	return $footer_text;
}
add_filter( 'admin_footer_text', 'my_custom_admin_credits' );
// END add admin credits