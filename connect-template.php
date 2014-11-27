<?php
/*
Template Name: Connect Groups
 */

get_header(); ?>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=true"></script>

<?php 
  $type = 'connect';
  $args=array(
    'post_type' => $type,
    'post_status' => 'publish',
    'posts_per_page' => 1000
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

    var connectgroups = [
      <?php $i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php
        	$info = get_the_content();
        	$loc = get_field("cg_location");
    	?>
        ['<?php the_title(); ?>','<?php echo $info; ?>',<?php echo $loc['lat']; ?>,<?php echo $loc['lng']; ?>],
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

  function recenter() {
    google.maps.event.trigger(map, 'resize');
    map.setCenter(center);
    map.fitBounds(bounds);
  }

  google.maps.event.addDomListener(window, 'load', initialize);
  google.maps.event.addDomListener(window, 'load', recenter);

  google.maps.event.addDomListener(window, 'resize', debounce(recenter,200));

  $(document).ready(function() {
    //recenter();
  });
</script>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
        <p>Please <a href="/contact">get in touch</a> if you're interested in joining a connect group!</p>
      </div>
    </article>
  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>