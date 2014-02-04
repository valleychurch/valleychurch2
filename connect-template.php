<?php
/*
Template Name: Connect Groups
 */

get_header(); ?>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3&sensor=true"></script>

<?php 
  $type = 'connect';
  $args=array(
    'post_type' => $type,
    'post_status' => 'publish'
  );
  $temp = $wp_query;  // assign orginal query to temp variable for later use   
  $wp_query = null;
  $wp_query = new WP_Query($args);
?>

<script type="text/javascript">
  google.maps.visualRefresh = true;

  var map,
      mapOptions,
      info,
      bounds,
      myloc,
      connectgroups,
      group,
      marker,
      pos,
      center = new google.maps.LatLng(53.733241, -2.662240);

  //Set up map
  function initialize() {
    mapOptions = {
      zoom: 9,
      center: center,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      rotateControl: false,
      panControl: false
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
    //Create info window
    info = new google.maps.InfoWindow({
      content: 'Loading...'
    });
    
    //Create bounds (to auto-size the map)
    bounds = new google.maps.LatLngBounds();
    
    //Find user's location
    myloc = new google.maps.Marker({
      icon: new google.maps.MarkerImage(
        '//maps.gstatic.com/mapfiles/mobile/mobileimgs2.png',
        new google.maps.Size(22,22),
        new google.maps.Point(0,18),
        new google.maps.Point(11,11)),
      shadow: null,
      zIndex: 999,
      map: map
    });

    var connectgroups = [
      <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php $info = get_the_content(); ?>
        ['<?php the_title(); ?>','<?php echo $info; ?>',<?php echo the_field('cg_location'); ?>],
      <?php $i++; endwhile; else : endif; ?>
      <?php wp_reset_query(); ?>
    ];

    //Add marker and info window for each group
    for (var i = 0; i < connectgroups.length; i++) {
      group = connectgroups[i];
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(group[2], group[3]),
        map: map,
        title: group[0],
        html: group[1]
      });
      google.maps.event.addListener(marker, 'click', function() {
        info.setContent("<h2 class='delta no-margin-bottom'>" + this.title + "</h2>" + this.html);
        info.open(map, this);
      });
      bounds.extend(new google.maps.LatLng(group[2], group[3]));
    }
    
    //Fit map
    map.fitBounds(bounds);
    recenter();
  }

  function myLocation() {
    //Determine if geolocation is supported
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        myloc.setPosition(pos);
        bounds.extend(pos);
        map.fitBounds(bounds);
        recenter();
        info.setContent("<h3 class='delta no-margin-bottom'>You are here!</h3>");
        info.open(map, myloc);
        google.maps.event.addListener(myloc, 'click', function(){
          info.setContent("<h3 class='delta no-margin-bottom'>You are here!</h3>");
          info.open(map, myloc);
        });
      }, function() {
        noGeoLoc(true);
      });
    }
    else {
      noGeoLoc(false);
    }
  }

  function noGeoLoc(errorFlag) {
    if (errorFlag) {
      alert('We couldn\'t find your current location.');
    }
    
    else {
      alert('Your browser doesn\'t support geolocation.');
    }
  }

  function recenter() {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(center);
    map.fitBounds(bounds);
  }

  google.maps.event.addDomListener(window, 'load', initialize);

  google.maps.event.addDomListener(window, 'resize', debounce(recenter,200));

  $(document).ready(function() {
    $('.my-location').click(function(e) {
      e.preventDefault();
      myLocation();
    });
  });
</script>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <?php if(get_field('page_css')) { ?>
    <style type="text/css">
      <?php the_field('page_css'); ?>
    </style>
  <?php } ?>

  <?php if (get_field('page_js')) { ?>
    <script type="text/javascript">
      <?php the_field('page_js'); ?>
    </script>
  <?php } ?>

  <?php
    $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
    $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
    $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
    $perm = get_permalink($post->ID);
  ?>

  <section class="container container--post">
    <article>
      <?php if (has_post_thumbnail()){ ?>
      <div class="featured">
        <img src="<?php echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
      </div>
      <?php } ?>
      <div class="content">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>

        <h2>Where do groups meet?</h2>
        <p>Our connect groups meet all over the region, check out the map below to find one near you!</p>
        <div class="aligncenter margin-bottom">
          <div class="fluid-width-video-wrapper" id="map-canvas" style="padding-top: 56.2%;"></div>
        </div>

        <h2>Interested in joining?</h2>
        <?php echo do_shortcode("[contact-form-7 id=\"6385\" title=\"Connect Groups\"]"); ?>
      </div>
    </article>
  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>