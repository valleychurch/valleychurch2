<?php
/*
Template Name: Find Us
 */

get_header(); ?>

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=true"></script>

<script>
// Declare all our variables
var
  map,
  mapOpts,
  mapStyle = [{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-100},{"lightness":40}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"saturation":-10},{"lightness":30}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":10}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"simplified"},{"saturation":-60},{"lightness":60}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"},{"saturation":-100},{"lightness":60}]}],
  bounds,
  locs,
  loc,
  icon = 'http://valleychurch.eu/wp-content/themes/valleychurch2/img/mapmarker.png';

function init() {
  mapOpts = {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDefaultUI: true,
    styles: mapStyle
  };

  map = new google.maps.Map(document.getElementById('map'), mapOpts);

  info = new google.maps.InfoWindow({
    content: 'Loading...'
  });

  bounds = new google.maps.LatLngBounds();

  locs = [
    ['Central',53.733246,-2.662242,'Valley Centre, Fourfields, Bamber Bridge, Preston, PR5 6GS'],
    ['Blackpool',53.806241,-3.049899,'Blackpool Football Club Hotel and Conference Centre, Bloomfield Road, Seasiders Way, Blackpool, FY1 6JJ'],
    //['Wigan',53.535815,-2.65844,'72 Mitchell Street, Wigan, WN5 9BY'],
  ];

  for (var i = 0; i < locs.length; i++) {
    loc = locs[i];
    marker = new google.maps.Marker({      
      map: map,
      title: loc[0],
      html: loc[3],
      position: new google.maps.LatLng(loc[1], loc[2]),
      icon: icon
    });
    bounds.extend(new google.maps.LatLng(loc[1], loc[2]));
    google.maps.event.addListener(marker, 'click', function() {
      info.setContent("<h2 class='epsilon no-margin-bottom'>" + this.title + "</h2>" + this.html);
        info.open(map, this);
    });
  }

  recenter();
}

function recenter() {
  google.maps.event.trigger(map, 'resize');
  map.fitBounds(bounds);
}

google.maps.event.addDomListener(window, 'resize', debounce(recenter,500));

$(document).ready(function() {
  init();
});
</script>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <section class="container container--post">
    <article>
      <!-- <?php if (has_post_thumbnail()){ ?> -->
      <div class="featured" style="height: 0; overflow: hidden; position: relative; padding-bottom: 30%; margin-left: 16px; margin-right: 16px;">
        <!-- <img src="<?php //echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /> -->
        <div id="map" style="position: absolute; display: block; width: 100%; height: 100%; top: 0; right: 0; bottom: 0; left: 0;"></div>
      </div>
      <!-- <?php } ?> -->
      <div class="content">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </article>
  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>