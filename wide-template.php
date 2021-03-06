﻿<?php
/*
  Template Name: Wide 
*/

get_header(); ?>


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
      <div class="content content--wide">
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </div>
    </article>
  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>