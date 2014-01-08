<?php

//Valley CDN url
function valleycdn() {
  global $valleycdn;
  $valleycdn = "http://cdn2.valleychurch.eu";
  return $valleycdn;
}

//Custom WordPress login
function my_custom_login() {
    echo
   '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

    <style type="text/css">
      body
      {
        background: #E8E8E8;
      }

      h1 a
      {
        background-image: url(http://cdn2.valleychurch.eu/img/icons/icon.svg) !important;
        background-size: contain !important;
        height: 130px !important;
        width: 100% !important;
      }

      .no-svg h1 a
      {
        background-image: url(http://cdn2.valleychurch.eu/img/icons/icon.png) !important;
      }

      #login
      {
        padding-top: 50px;
      }

      .login form
      {
        padding: 26px;
      }
    </style>';
}

add_action('login_head', 'my_custom_login');



//Deregister head
function remove_head() {
  wp_deregister_script('jquery');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'wp_generator');
}

add_action("wp_enqueue_scripts", "remove_head", 11);

if (!is_single()) {
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
}



//Register WP menus
function register_my_menus() {
  register_nav_menus(
    array( 'main-nav' => __( 'Main Nav' ) )
  );
}

add_action( 'init', 'register_my_menus' );



//Register custom post types
function create_my_post_types() {
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' ),
        'add_new' => _x('Add New', 'events'),
            'add_new_item' => __('Add New Event'),
            'edit_item' => __('Edit Event'),
            'new_item' => __('New Event'),
            'all_items' => __('All Events'),
            'view_item' => __('View Event'),
            'search_items' => __('Search Events'),
            'not_found' =>  __('No events found'),
            'not_found_in_trash' => __('No events found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => 'Events'
      ),
      'public' => true,
      'archive' => false,
      'show_ui' => true, // UI in admin panel
      '_builtin' => false, // It's a custom post type, not built in!
      'hierarchical' => false,
      'supports' => array( 'title', 'editor', 'revisions', 'thumbnail' ),
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 6,
      'rewrite' => array( 'slug' => 'event', 'with_front' => false ),
    )
  );

  register_post_type( 'slider',
    array(
      'labels' => array(
        'name' => __( 'Home Slides' ),
        'singular_name' => __( 'Slide' ),
        'add_new' => _x('Add New', 'slide'),
            'add_new_item' => __('Add New Slide'),
            'edit_item' => __('Edit Slide'),
            'new_item' => __('New Slide'),
            'all_items' => __('All Slides'),
            'view_item' => __('View Slide'),
            'search_items' => __('Search Slides'),
            'not_found' =>  __('No slides found'),
            'not_found_in_trash' => __('No slides found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => 'Home Slides'
      ),
      'public' => true,
      'archive' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 9,
      'rewrite' => array( 'slug' => 'slider', 'with_front' => false ),
      'supports' => array( 'title', 'revisions' ),
    )
  );

  register_post_type( 'podcast',
    array(
      'labels' => array(
        'name' => __( 'Messages' ),
        'singular_name' => __( 'Message' ),
        'add_new' => _x('Add New', 'podcast'),
            'add_new_item' => __('Add New Message'),
            'edit_item' => __('Edit Message'),
            'new_item' => __('New Message'),
            'all_items' => __('All Messages'),
            'view_item' => __('View Message'),
            'search_items' => __('Search Messages'),
            'not_found' =>  __('No messages found'),
            'not_found_in_trash' => __('No messages found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => 'Messages'
      ),
      'public' => true,
      'show_ui' => true,
      'archive' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_position' => 8,
      'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
      'rewrite' => array( 'slug' => 'message', 'with_front' => false ),
    )
  );

  register_post_type( 'connect',
    array(
      'labels' => array(
        'name' => __( 'Connect Groups' ),
        'singular_name' => __( 'Connect Group' ),
        'add_new' => _x('Add New', 'connect'),
            'add_new_item' => __('Add New Connect Group'),
            'edit_item' => __('Edit Connect Group'),
            'new_item' => __('New Connect Group'),
            'all_items' => __('All Connect Groups'),
            'view_item' => __('Connect Group'),
            'search_items' => __('Connect Groups'),
            'not_found' =>  __('No connect groups found'),
            'not_found_in_trash' => __('No connect groups found in Trash'), 
            'parent_item_colon' => '',
            'menu_name' => 'Connect Groups'
      ),
      'public' => true,
      'archive' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 10,
      'rewrite' => array( 'slug' => 'connect', 'with_front' => false ),
      'supports' => array( 'title', 'editor', 'revisions' ),
    )
  );
}

add_action( 'init', 'create_my_post_types' );



//Add featured images
add_theme_support('post-thumbnails');



//Add extra class to body if post/page has a featured image
add_action('body_class', 'ed_if_featured_image_class' );
function ed_if_featured_image_class($classes) {
 if ( has_post_thumbnail() ) {
  array_push($classes, 'has-featured-image');
 }
 return $classes;
}



//Add custom css for TinyMCE
add_editor_style('editor-style.css');



//Add TypeKit to TinyMCE
function tomjn_mce_external_plugins($plugin_array){
  $plugin_array['typekit']  =  'http://cdn2.valleychurch.eu/js/typekit.tinymce.js';
    return $plugin_array;
}

add_filter("mce_external_plugins", "tomjn_mce_external_plugins");



//Add featured images to RSS
function featuredtoRSS($content) {
  global $post;

  if ( has_post_thumbnail( $post->ID ) ){
    $content = '' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'display: block;' ) ) . '' . $content;
  }

  return $content;
}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');



//Add connect groups to a select menu
function ses_add_connect_list_to_contact_form ( $tag, $unused ) {  
  
    if ( $tag['name'] != 'connect-list' )
        return $tag;  
  
    $args = array (
  		'posts_per_page' => 100,
      	'post_type' => 'connect',
      	'orderby' => 'title',
      	'order' => 'ASC'
      );  

    $connects = get_posts($args);  
  
    if ( ! $connects )  
        return $tag;  
  
    foreach ( $connects as $group ) {  
        $tag['raw_values'][] = $group->post_title;  
        $tag['values'][] = $group->post_title;  
        $tag['labels'][] = $group->post_title;  
        $tag['pipes']->pipes[] = array ( 'before' => $group->post_title, 'after' => $group->post_title);  
    }  
  
    return $tag;  
}

add_filter( 'wpcf7_form_tag', 'ses_add_connect_list_to_contact_form', 10, 2);  



?>