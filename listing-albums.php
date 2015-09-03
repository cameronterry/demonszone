<article <?php post_class( array( 'article', 'clearfix' ) ); ?>>
	<div>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail"><?php the_post_thumbnail( 'album-small' ); ?></div>
		<?php endif; ?>
		<h2>
			REVIEW : <a href="<?php the_permalink(); ?>"><?php the_title(); ?> by <?php dz_album_artist(); ?></a>
		</h2>
		<?php the_excerpt(); ?>
		<p class="attribution">
			Posted on <time><?php echo( get_the_date() ); ?></time>
			by <?php the_author_posts_link(); ?>
			<?php the_terms( get_the_ID(), 'genres', ' | Genres: ', ', ', '' ); ?>
		</p>
	</div>
</article>