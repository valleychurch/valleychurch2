<?php
/**
 * The template for displaying search forms
 */
?>
<form method="get" id="search" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search__field" name="s" id="s" placeholder="Search valleychurch.eu..." value="<?php the_search_query(); ?>" />
	<div class="search__button">
		<button type="submit" class="search__button" name="submit" id="searchsubmit"><i class="fa fa-lg fa-search"></i></button>
	</div>
</form>