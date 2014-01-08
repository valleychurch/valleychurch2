<?php get_header(); ?>

<section class="container container--post">

  <div class="col col--third left cf">
    <div class="content">
      <h1 class="no-margin-bottom"><a href="/thelatest">The Latest</a></h1>
      <h2 class="delta lite">Catch up with goings-on in the life of Valley Church!</h2>
      <p>We're all about <a href="/about">empowering you to be all that God's called you to be</a>, so check back weekly for inspirational thoughts, blogs and messages from our Pastors and team.</p>
    </div>
  </div>

  <div class="col col--two--thirds right cf">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article>

      <?php
        $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
        $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
        $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
        $perm = get_permalink($post->ID);
      ?>

      <?php if (has_post_thumbnail()){ ?>
      <!-- <div class="wrap-img"> -->
        <img src="<?php echo($image[0]); ?>" class="margin-bottom" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
      <!-- </div> -->
      <?php } ?>

      <div class="content">
        <h2 class="no-margin-bottom">
          <?php the_title(); ?>
        </h2>
        <p class="delta lite">
          Posted <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time> by <?php the_author();?>
        </p>

        <?php the_content(); ?>
      </div>
    </article>

    <hr/>

    <?php endwhile; else : ?>

    <div class="post wrap padding center">
      <h1>Sorry, the page you're looking for doesn't exist!</h1>
      <p>You can either use the search below to find what you're looking for, or head back to the <a href="<?php bloginfo('url'); ?>">home page.</a></p>
      <?php get_search_form(); ?>
    </div>

    <?php endif; ?>

  </div>

  <div class="col col--third left cf">
    <div class="content">
      <p><strong>You might like some of these posts:</strong></p>
    </div>
    <?php related_posts(); ?>
    <hr/>
  </div>

  <div class="col col--two--thirds right cf">
    <?php comments_template(); ?>  
  </div>

</section>

<?php get_footer(); ?>