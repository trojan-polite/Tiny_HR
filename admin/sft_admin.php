<?php
/* Create widget */
class wp_simple_fading_testimonials extends WP_Widget {

// constructor
function wp_simple_fading_testimonials() {
  parent::WP_Widget(false, $name = __('Simple Fading Testimonials', 'wp_widget_plugin') );
}

// widget form creation
function form($instance) {

// check values
if( $instance) {
     $widget_custom_title = esc_attr($instance['widget_custom_title']);
     $number_testimonials = esc_attr($instance['number_testimonials']);
     $duration_testimonial = esc_attr($instance['duration_testimonial']);
     $speed_transition = esc_attr($instance['speed_transition']);
     $author_prefix = esc_attr($instance['author_prefix']);
} else {
     $widget_title = '';
     $number_testimonials = '';
     $duration_testimonial = '';
     $speed_transition = '';
     $author_prefix = '';
} ?>

<!-- set widget title -->
<p>
  <label for="<?php echo $this->get_field_id('widget_custom_title'); ?>"><?php _e('Widget Title <em>(leave blank for none)</em>:', 'wp_widget_plugin'); ?></label>
  <br><input id="<?php echo $this->get_field_id('widget_custom_title'); ?>" name="<?php echo $this->get_field_name('widget_custom_title'); ?>" type="text" value="<?php echo $widget_custom_title; ?>" />
</p>

<!-- set number of testimonials -->
<p>
<label for="<?php echo $this->get_field_id('number_testimonials'); ?>"><?php _e('Number of testimonials to display:', 'wp_widget_plugin');
  // count total posts
  $count_posts = wp_count_posts( 'testimonial' );
  // count total published testimonial posts
  $total = $count_posts->publish; //
  // cast total to integer
  $int = (int)$total;
  // create blank array
  $total_array = array();
  // populate array
  $x=1;
    while($x <= $int) {
      $total_array[] = $x;
      $x++;
  }?></label>
<select name="<?php echo $this->get_field_name('number_testimonials'); ?>" id="<?php echo $this->get_field_id('number_testimonials'); ?>" class="">
<?php
$options = $total_array;
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $number_testimonials == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select>
</p>

<!-- set duration -->
<p>
<label for="<?php echo $this->get_field_id('duration_testimonial'); ?>"><?php _e('Duration of each testimonial (<em>ms</em>):', 'wp_widget_plugin'); ?></label>
<input id="<?php echo $this->get_field_id('duration_testimonial'); ?>" name="<?php echo $this->get_field_name('duration_testimonial'); ?>" type="number" value="<?php echo $duration_testimonial; ?>" />
</p>

<!-- set transition speed -->
<p>
<label for="<?php echo $this->get_field_id('speed_transition'); ?>"><?php _e('Transition speed (<em>ms</em>):', 'wp_widget_plugin'); ?></label>
<input id="<?php echo $this->get_field_id('speed_transition'); ?>" name="<?php echo $this->get_field_name('speed_transition'); ?>" type="number" value="<?php echo $speed_transition; ?>" />
</p>

<!-- set testimonial author preflix -->
<p>
<label for="<?php echo $this->get_field_id('author_prefix'); ?>"><?php _e('Author prefix:', 'wp_widget_plugin'); ?></label>
<select name="<?php echo $this->get_field_name('author_prefix'); ?>" id="<?php echo $this->get_field_id('author_prefix'); ?>" class="">
 <?php
$prefixes = array('', '-', '--', '•','~');
    foreach ($prefixes as $prefix) {
    echo '<option value="' . $prefix . '" id="' . $prefix . '"', $author_prefix == $prefix ? ' selected="selected"' : '', '>';
      // check if prefix is empty
      if ($prefix == "") {
        echo "(no prefix)";
      } else {
        echo $prefix;
      };
    echo '</option>';
}
?>
 </select>
</p>


<?php }
// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // assign fields
      $instance['widget_custom_title'] = strip_tags($new_instance['widget_custom_title']);
      $instance['number_testimonials'] = strip_tags($new_instance['number_testimonials']);
      $instance['duration_testimonial'] = strip_tags($new_instance['duration_testimonial']);
      $instance['speed_transition'] = strip_tags($new_instance['speed_transition']);
      $instance['author_prefix'] = strip_tags($new_instance['author_prefix']);
      return $instance;
}


// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $widget_custom_title =  $instance['widget_custom_title'];
   $number_testimonials = (int)$instance['number_testimonials']; // cast number of testimonials to integer
   $author_prefix =  $instance['author_prefix'];
   echo $before_widget; // assign widget ID and class

    // Query Testimonials Custom Field
    $args = array(
      'posts_per_page' => $number_testimonials,
      'post_type' => 'testimonial'
    );
    // The Query
    query_posts( $args );
      if ($widget_custom_title) { // check if field is set
        echo "<h3 class=\"widget-title\">$widget_custom_title</h3>";
      };
    echo '<ul>';
    // The Loop
    while ( have_posts() ) : the_post();
        $testimonial_author = get_the_title(); // grab the title
        $testimonial_content = get_the_content(); // grab the content
            echo '<li>';
        if ($testimonial_content) { // check if field is set
            echo '<p class="testimonial_content">'.$testimonial_content.'</p>';
        };
            if ($testimonial_author) { // check if field is set
                echo '<p class="testimonial_author">';
                if($author_prefix) { // check if field is set
                  echo $author_prefix.' ';
                };
                echo $testimonial_author. '</p>';
            };
            echo '</li>';
    endwhile;
    echo '</ul>'.$after_widget;
    // Reset Query
    wp_reset_query();



// var_dump($instance['speed_transition']);

// function pw_load_scripts() {

//     wp_enqueue_script('pw-script', plugin_dir_url( __FILE__ ) . '/assets/js/load_fader.js');
//     wp_localize_script('pw-script', 'pw_script_vars', array(
//             // 'alert' => __('Hey! You have clicked the button jim!', 'pippin'),
//             'delaySpeed' => $instance['speed_transition']
//         )
//     );

// }
// add_action('wp_enqueue_scripts', 'pw_load_scripts');

}}


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


// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_simple_fading_testimonials");'));

?>