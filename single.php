<?php get_header(); ?>

<section class="container container--post">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article>

    <?php
      $img_id = get_post_thumbnail_id($post->ID); // This gets just the ID of the img
      $image = wp_get_attachment_image_src($img_id, $optional_size); // Get URL of the image, and size can be set here too (same as with get_the_post_thumbnail, I think)
      $alt_text = get_post_meta($img_id , '_wp_attachment_image_alt', true);
      $perm = get_permalink($post->ID);
    ?>

    <?php if (has_post_thumbnail()){ ?>
    <div class="featured">
      <img src="<?php echo($image[0]); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
    </div>
    <?php } ?>

    <div class="content">
      <span class="meta milli">
        <span class="meta__category">
          <?php the_category(', '); ?>
        </span>
        &bull;
        <span class="meta__date">
          <time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time>
        </span>
        &bull;
        <span class="meta__author">
          By <span class="meta__author__name"><?php the_author();?></span>
        </span>
      </span>
      <h1>
        <?php the_title(); ?>
      </h1>

      <?php the_content(); ?>
    </div>
  </article>

  <hr/>

  <?php endwhile; else : ?>

  <div class="content">
    <h1>Sorry, the page you're looking for doesn't exist!</h1>
    <p>You can either use the search below to find what you're looking for, or head back to the <a href="<?php bloginfo('url'); ?>">home page.</a></p>
    <?php get_search_form(); ?>
  </div>

  <?php endif; ?>

  <div class="comments">
    <?php comments_template(); ?>
  </div>

</section>

<?php get_footer(); ?>