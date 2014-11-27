<?php
/*
  Template Name: Messages 
*/

get_header(); ?>

<section class="container container--post">

  <div class="col col--third left cf">
    <div class="content">
      <h1 class="no-margin-bottom">Messages</h1>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
      <?php wp_reset_query(); ?>
    </div>
  </div>

  <div class="col col--two--thirds right cf">

    <?php 
      $type = 'podcast';
      $args=array(
        'post_type' => $type,
        'post_status' => 'publish'
      );
      $temp = $wp_query;  // assign orginal query to temp variable for later use   
      $wp_query = null;

      function filter_where( $where = '' ) {
        // posts in the last 25 days (accounts for 4 weeks of messages)
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-35 days')) . "'";
        return $where;
      }

      add_filter( 'posts_where', 'filter_where' );
      $wp_query = new WP_Query($args);
      remove_filter( 'posts_where', 'filter_where' );
    ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article class="media">

      <?php
        $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
        $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
        $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
        $perm = get_permalink($post->ID);
      ?>

      <?php if ( has_post_thumbnail() ) { ?>
        <div class="media__img col--quarter">
          <img src="<?php echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="<?php echo($image[1]);?>" height="<?php echo($image[2]); ?>" />
        </div>
      <?php } ?>
      <div class="media__body col--three-quarters">
        <h3 class="epsilon">
          <?php the_title(); ?>
        </h3>
        <p><?php echo get_the_content(); ?></p>
        <small><?php the_powerpress_content(); ?></small>
      </div>

    </article>

    <?php endwhile; else : ?>

    <div class="content">
      <h1>Sorry, the page you're looking for doesn't exist!</h1>
      <p>You can either use the search below to find what you're looking for, or head back to the <a href="<?php bloginfo('url'); ?>">home page.</a></p>
      <?php get_search_form(); ?>
    </div>

    <?php endif; ?>

  </div>

</section>

<?php get_footer(); ?>