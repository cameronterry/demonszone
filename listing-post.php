<article <?php post_class( array( 'article', 'clearfix' ) ); ?>>
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div>
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="thumbnail"><?php the_post_thumbnail( 'news-thumb' ); ?></div>
		<?php endif; ?>
		<?php the_excerpt(); ?>
		<p class="attribution">
			Posted on <time><?php echo( get_the_date() ); ?></time>
			by <?php the_author_posts_link(); ?>
			<?php the_terms( get_the_ID(), 'artist', ' | Artist(s): ', ', ', '' ); ?>
		</p>
	</div>
</article>