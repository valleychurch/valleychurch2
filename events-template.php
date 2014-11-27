<?php
/*
  Template Name: Events 
*/

get_header(); ?>

<section class="container container--post">

  <div class="col col--third left cf">
    <div class="content">
      <h1 class="no-margin-bottom">Events</h1>
      <h2 class="delta lite">We always have loads going on&mdash;make sure you're in the know and get inviting your world!</h2>
    </div>
  </div>

  <div class="col col--two--thirds right cf">

    <?php
      $type = 'events';
      $args = array(
        'post_type' => $type,
        'post_status' => 'publish'
        );
      $temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query($args);
    ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article>

      <?php
        $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
        $sm_img = wp_get_attachment_image_src($img_id, 'medium');
        $md_img = wp_get_attachment_image_src($img_id, 'large');
        $lg_img = wp_get_attachment_image_src($img_id, 'full');
        $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
        $perm = get_permalink($post->ID);
      ?>

      <?php if (has_post_thumbnail()){ ?>
      <div class="featured hisrc">
        <img src="<?php echo($sm_img[0]); ?>" data-1x="<?php echo($md_img[0]); ?>" data-2x="<?php echo($lg_img[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" class="margin-bottom" />
      </div>
      <?php } ?>

      <div class="content">
        <h2 class="no-margin-bottom">
          <?php the_title(); ?>
        </h2>
        <?php if(get_field('event_date')) { ?>
          <p class="delta lite">
            <?php if(get_field('event_time')) { ?>
              <?php
                echo the_field('event_date');
                echo ', ';
                echo the_field('event_time');
              ?>
            <?php } else { ?>
              <?php the_field('event_date'); ?>
            <?php } ?>
          </p>
        <?php } ?>
        <?php if (get_field('event_venue')) { ?>
          <p class="epsilon lite">
            Held at:
            <?php if (get_field('event_map_link')) { ?>
              <a href="<?php the_field('event_map_link'); ?>" target="_blank">
                <?php the_field('event_venue'); ?>
              </a>
            <?php } else { ?>
              <?php the_field('event_venue'); ?>
            <?php } ?>
          </p>
        <?php } ?>

        <?php the_content(); ?>
      </div>
    </article>

    <?php endwhile; else : ?>

    <div class="content">
      <h1>Sorry, the page you're looking for doesn't exist!</h1>
      <p>You can either use the search below to find what you're looking for, or head back to the <a href="<?php bloginfo('url'); ?>">home page.</a></p>
      <?php get_search_form(); ?>
    </div>

    <?php endif; ?>
    <?php wp_reset_query(); ?>

  </div>

  <div class="col col--third left cf">
    <div class="content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </div>
  </div>

</section>

<?php get_footer(); ?>