<article id="post-<?php the_ID(); ?>" <?php post_class( 'cell' ); ?>>
	<a href="<?php the_permalink(); ?>">
		<h2 class="site"><?php the_title(); ?></h2>
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'dz-rectangle-medium' ); ?>
		<?php else : ?>
			<img src="http://placehold.it/400x225" title="Placeholder" />
		<?php endif; ?>
	</a>
</article>
