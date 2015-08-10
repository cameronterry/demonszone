<?php get_header(); ?>
	<main class="single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'article' ); ?>>
				<h1><?php the_title(); ?></h1>
				<p class="attribution">
					Posted on
					<time><?php the_date(); ?></time>
					by
					<?php the_author_posts_link(); ?>
				</p>
				<?php the_content(); ?>
			</article>
			<aside class="col">
				<?php $related_albums = dz_get_related_albums(); ?>
				<?php if ( $related_albums->have_posts() ) : ?>
					<h2 class="heading">Related Albums:</h2>
					<?php while ( $related_albums->have_posts() ) : $related_albums->the_post(); ?>
						<article <?php post_class( array( 'related-article', 'image-overlay' ) ); ?>>
							<a href="<?php the_permalink(); ?>">
								<div class="thumb"><?php the_post_thumbnail( 'album-small' ); ?></div>
								<div class="overlay">
									<div class="details">
										<h3><?php the_title(); ?></h3>
										<p class="artist"><?php dz_album_artist(); ?></p>
										<p class="rating">10 / 10</p>
									</div>
								</div>
							</a>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</aside>
			<aside class="col">
				Hello world
			</aside>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>