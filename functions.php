<?php

//Custom WordPress login
function my_custom_login() {
    echo
   '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

    <style type="text/css">
      html,
      body.login
      {
        background: #E8E8E8;
      }

      h1 a
      {
        background-image: url(http://cdn.valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon.svg) !important;
        background-size: contain !important;
        height: 130px !important;
        width: 100% !important;
      }

      .no-svg h1 a
      {
        background-image: url(http://cdn.valleychurch.eu/wp-content/themes/valleychurch2/img/icons/icon.png) !important;
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

// add_action('login_head', 'my_custom_login');



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
      //'taxonomies' => array('category'),
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

  //Prepping for v3
  register_post_type( 'location',
    array(
      'labels' => array(
        'name' => __( 'Locations' ),
        'singular_name' => __( 'Location' ),
        'add_new' => _x('Add New', 'location'),
            'add_new_item' => __('Add New Location'),
            'edit_item' => __('Edit Location'),
            'new_item' => __('New Location'),
            'all_items' => __('All Locations'),
            'view_item' => __('View Location'),
            'search_items' => __('Search Locations'),
            'not_found' =>  __('No locations found'),
            'not_found_in_trash' => __('No locations found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Locations (DO NOT USE)'
      ),
      'public' => true,
      'archive' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 9,
      'rewrite' => array( 'slug' => 'location', 'with_front' => false ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
    )
  );

  register_post_type( 'staff',
    array(
      'labels' => array(
        'name' => __( 'Staff Members' ),
        'singular_name' => __( 'Staff Member' ),
        'add_new' => _x('Add New', 'staff'),
            'add_new_item' => __('Add New Staff Member'),
            'edit_item' => __('Edit Staff Member'),
            'new_item' => __('New Staff Member'),
            'all_items' => __('All Staff Members'),
            'view_item' => __('View Staff Member'),
            'search_items' => __('Search Staff Members'),
            'not_found' =>  __('No staff members found'),
            'not_found_in_trash' => __('No staff members found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Staff Members (DO NOT USE)'
      ),
      'public' => true,
      'archive' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 9,
      'rewrite' => array( 'slug' => 'staff', 'with_front' => false ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
    )
  );

  register_post_type( 'notification',
    array(
      'labels' => array(
        'name' => __( 'Notifications' ),
        'singular_name' => __( 'Notification' ),
        'add_new' => _x('Add New', 'notifications'),
            'add_new_item' => __('Add New Notification'),
            'edit_item' => __('Edit Notification'),
            'new_item' => __('New Notification'),
            'all_items' => __('All Notifications'),
            'view_item' => __('View Notification'),
            'search_items' => __('Search Notifications'),
            'not_found' =>  __('No notifications found'),
            'not_found_in_trash' => __('No notifications found in Trash'),
            'parent_item_colon' => '',
            'menu_name' => 'Notifications (DO NOT USE)'
      ),
      'public' => true,
      'archive' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => true,
      'menu_position' => 9,
      'rewrite' => array( 'slug' => 'notification', 'with_front' => false ),
      'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
    )
  );
}

add_action( 'init', 'create_my_post_types' );



//Create custom taxonomies
function create_custom_taxonomies() {
  register_taxonomy('series', 'podcast', create_custom_taxonomy_args('series', 'Series') );
  register_taxonomy('location_type', 'location', create_custom_taxonomy_args('type', 'Location Type') );
};
add_action( 'init', 'create_custom_taxonomies' );


function create_custom_taxonomy_args($name, $label = null) {
  $nameplural = check_plural( $name );
  $labelplural = check_plural( $label );
  $singular = create_singular( $name, $label );
  $plural = create_plural( $name, $label, $nameplural, $labelplural );
  $args = array(
    'hierarchical' => true,
    'labels' => array(
      'name' => $plural,
      'singular_name' => $singular,
      'add_new' => _x( 'Add New', $name ),
      'add_new_item' => __( 'Add New ' . $singular ),
      'edit_item' => __( 'Edit ' . $singular ),
      'new_item' => __( 'New ' . $singular ),
      'all_items' => __('All ' . $plural),
      'view_item' => __('View ' . $singular ),
      'search_items' => __('Search ' . $plural),
      'not_found' =>  __('No ' . $plural . ' found'),
    ),
    'show_admin_column' => true,
    'public' => true,
    'rewrite' => array(
      'slug' => $name, // This controls the base slug that will display before each term
      'with_front' => false // Don't display the category base before
    ),
  );

  return $args;
}

// Check if things are plural
function check_plural($string) {
  return ( substr( $string, -1 ) == 's' );
}

function create_singular($name, $label = null) {
  return ( ( $label != null ) ? ( $label ) : ( ucwords( $name ) ) );
}

function create_plural($name, $label = null, $nameplural, $labelplural) {
  return ( ( $label != null ) ?( $labelplural ? $label : $label . 's' ) : ( $nameplural ? ucwords( $name ) : ucwords( $name ) . 's' ) );
}

//Add featured images
add_theme_support('post-thumbnails');
add_image_size( 'slide', 2000, 1125, true );       // Slide width
add_image_size( 'slide-small', 1280, 720, true );  // Slide width small
add_image_size( 'slide-xsmall', 640, 360, true );  // Slide width xsmall
add_image_size( 'banner', 2000, 800, true );       // Featured image banner size
add_image_size( 'banner-small', 1500, 800, true ); // Featured image banner size small
add_image_size( 'banner-xsmall', 750, 600, true ); // Featured image banner size xsmall


//Compress jpgs to 80% quality
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );


//Add extra class to body if post/page has a featured image
add_action('body_class', 'ed_if_featured_image_class' );
function ed_if_featured_image_class($classes) {
 if ( has_post_thumbnail() ) {
  array_push($classes, 'featured-image');
 }
 else {
  array_push($classes, 'no-featured-image');
 }
 return $classes;
}



//Add custom css for TinyMCE
add_editor_style('editor-style.css');



//Add TypeKit to TinyMCE
function tomjn_mce_external_plugins($plugin_array){
  $plugin_array['typekit']  =  'http://cdn.valleychurch.eu/wp-content/themes/valleychurch2/js/typekit.tinymce.js';
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