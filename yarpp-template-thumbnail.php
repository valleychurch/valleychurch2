<?php
/*
YARPP Template: Thumbnails
Description: Requires a theme which supports post thumbnails
Author: mitcho (Michael Yoshitaka Erlewine)
*/ ?>
<?php if (have_posts()):?>
<?php $count = 1; ?>
<ul class="post-related cf">
	<?php while (have_posts()) : the_post(); ?>
    <li class="col <?php echo "col-" . $count . ""; ?>">
		<?php if (has_post_thumbnail()):?>
		  <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="post-related-img"><?php the_post_thumbnail(); ?></a>
		<?php endif; ?>
      <h3 class="epsilon no-margin-bottom"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
      <p class="zeta"><time datetime="<?php the_time('c'); ?>"><?php the_time('F jS, Y'); ?></time></p>
    </li>
    <?php $count++; ?>
	<?php endwhile; ?>
</ul>

<?php else: ?>
<p>No related photos.</p>
<?php endif; ?>
