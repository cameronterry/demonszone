<article id="albums-<?php the_ID(); ?>" <?php dz_post_class( 'cell' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<h2 class="site"><?php the_title(); ?></h2>
		<?php the_post_thumbnail( 'dz-square-medium' ); ?>
		<div class="rating site"><?php dz_the_rating(); ?></div>
	</a>
</article>
