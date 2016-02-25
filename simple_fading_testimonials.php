<?php
/**
 * Plugin Name: Simple Fading Testimonials
 * Plugin URI: http://stephenkempin.co.uk
 * Description: Easily add revolving and fading testimonials to your site, via widgets.
 * Version: 1.0.0
 * Author: Stephen Kempin
 * Author URI: http://www.stephenkempin.co.uk
 * License: GPL2
 */

/*  Copyright 2015  Stephen Kempin (email : info@stephenkempin.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

  You may find a copy of the GNU General Public License at http://www.gnu.org/licenses/gpl.html
*/ 

// require admin files
require_once 'admin/sft_admin.php';


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



/**
 * Register with hook 'wp_enqueue_scripts', which can be used for front end CSS and JavaScript
 */
add_action( 'wp_enqueue_scripts', 'sft_js_css' );

function sft_js_css() {
    wp_register_style( 'sft-style', plugins_url('/assets/css/style.css', __FILE__) );
    wp_register_script( 'sft-js', plugins_url( '/assets/js/fader.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'sft-style' );
    wp_enqueue_script( 'sft-js' );
}







function wpb_adding_scripts() {
wp_register_script( 'my-amazing-script', plugins_url( '/assets/js/run.js', __FILE__ ), array( 'jquery' ), true );
wp_enqueue_script('my-amazing-script');
}
add_action( 'wp_footer', 'wpb_adding_scripts' ); 





?>