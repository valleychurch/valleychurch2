<?php get_header(); ?>

<section class="container container--post">

  <div class="col col--third left cf">
    <div class="content">
      <h1 class="kilo no-margin-bottom">Search</h1>
      <h2 class="delta lite">You have searched for <?php the_search_query(); ?></h2>

      <p class="no-margin-bottom">Search again:</p>
      <?php get_search_form(); ?>
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
      <div class="featured">
        <img src="<?php echo($image[0]); ?>" class="margin-bottom" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
      </div>
      <?php } ?>

      <div class="content">
        <h2 class="no-margin-bottom">
          <a href="<?php echo get_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>

        <?php the_excerpt(); ?>
      </div>
    </article>

    <?php endwhile; ?>

    <div class="pagination content margin-bottom">
      <?php next_posts_link('<div class="btn left">&laquo; Older Entries</div>') ?>
      <?php previous_posts_link('<div class="btn right">Newer Entries &raquo;</div>') ?>
    </div>

  	<?php else : ?>

    <div class="content">
      <h1>Sorry, the page you're looking for doesn't exist!</h1>
      <p>You can either use the search below to find what you're looking for, or head back to the <a href="<?php bloginfo('url'); ?>">home page.</a></p>
      <?php get_search_form(); ?>
    </div>

    <?php endif; ?>

  </div>

</section>

<?php get_footer(); ?>