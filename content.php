<article <?php post_class( array( 'image-overlay' ) ); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="thumb"><?php the_post_thumbnail( 'album-small' ); ?></div>
		<div class="overlay">
			<div class="details">
				<h3><?php the_title(); ?></h3>
				<p class="artist"><?php dz_album_artist(); ?></p>
				<p class="rating"><?php dz_album_rating( '' ); ?></p>
			</div>
		</div>
		<?php if( dz_album_is_recent() ) : ?>
			<div class="just-added">Just Added</div>
		<?php endif; ?>
	</a>
</article>