<?php
/*
Template Name: Home
 */

get_header(); ?>

<section class="container container--home">

  <div class="container--home__slider col cf">
    <?php
      $type = 'slider';
      $args = array(
        'post_type' => $type,
        'post_status' => 'publish'
        );
      $temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query($args);
    ?>
    <ul class="slides">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
          <?php if ( get_field('slider_link') ) { ?>
            <a href="<?php the_field( "slider_link" ); ?>">
              <img src="<?php the_field( "slider_image" ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
            </a>
          <?php } else { ?>
            <img src="<?php the_field( "slider_image" ); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
          <?php } ?>
        </li>
      <?php endwhile; else: endif; ?>
      <?php wp_reset_query(); ?>
    </ul>
    <div class="slide-control"></div>

  </div>

  <!-- BUTTONS -->
  <div class="container--home__buttons cf">

    <div class="col col--quarter left">
      <a href="/about" class="home__button home__button--about">
        <span class="delta">About Valley</span>
      </a>
    </div>

    <div class="col col--quarter left">
      <a href="/sunday" class="home__button home__button--sundays">
        <span class="delta">Sundays</span>
      </a>
    </div>

    <div class="col col--quarter left">
      <a href="/pastors" class="home__button home__button--pastors">
        <span class="delta">Senior Pastors</span>
      </a>
    </div>

    <div class="col col--quarter left">
      <a href="/findus" class="home__button home__button--find">
        <span class="delta">Find us</span>
      </a>
    </div>

  </div>

  <div class="container--home__blog col col--two--thirds right">
    <h2><a href="/thelatest">The Latest</a></h2>

    <?php
      $type = 'post';
      $args = array(
        'post_type' => $type,
        'post_status' => 'publish',
        'posts_per_page' => 1
        );
      $temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query($args);
    ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article>

      <?php
        $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
        $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
        $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
        $perm = get_permalink($post->ID);
      ?>

      <?php if ( has_post_thumbnail() ) { ?>
        <div class="featured">
          <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
            <img class="margin-bottom" src="<?php echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="<?php echo($image[1]);?>" height="<?php echo($image[2]); ?>" />
          </a>
        </div>
      <?php } ?>

      <div class="content">
        <h3 class="gamma no-margin-bottom">
          <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
          </a>
        </h3>
        <p class="epsilon lite">
          Posted <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time> by <?php the_author();?>
        </p>

        <?php the_content(); ?>

        <p>
          <?php comments_popup_link(); ?>
        </p>
      </div>
    </article>

    <?php endwhile; else: endif; ?>
    <?php wp_reset_query(); ?>
  </div>

  <div class="container--home__messages col col--third left">
    <h2><a href="/messages">Messages</a></h2>
    <?php 
      $type = 'podcast';
      $args=array(
        'post_type' => $type,
        'post_status' => 'publish'
      );
      $temp = $wp_query;  // assign orginal query to temp variable for later use   
      $wp_query = null;

      function filter_where( $where = '' ) {
        // posts in the last 8 days (accounts for 1 week of messages)
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
        return $where;
      }

      add_filter( 'posts_where', 'filter_where' );
      $wp_query = new WP_Query($args);
      remove_filter( 'posts_where', 'filter_where' );
    ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

      <?php
        $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
        $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
        $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
        $perm = get_permalink($post->ID);
      ?>

      <article>
        <div class="media margin-bottom">
          <?php if ( has_post_thumbnail() ) { ?>
            <div class="media__img col--quarter">
              <img src="<?php echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="<?php echo($image[1]);?>" height="<?php echo($image[2]); ?>" />
            </div>
          <?php } ?>
          <div class="media__body col--three-quarters">
            <h3 class="epsilon">
              <a href="/messages">
                <?php the_title(); ?>
              </a>
            </h3>
          </div>
        </div>
        <div class="content">
          <p><?php echo get_the_content(); ?></p>
          <small><?php the_powerpress_content(); ?></small>
        </div>
      </article> 

    <?php endwhile; else : ?>

      <h3 class="epsilon">
        No recent messages found
      </h3>

    <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
</section>

<?php get_footer(); ?>