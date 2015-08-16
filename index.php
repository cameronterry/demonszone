<?php get_header(); ?>
	<main class="main-content single clearfix" role="main">
		<section class="news clearfix">
			<h2>Headlines</h2>
		</section>
		<section class="albums clearfix">
			<h2>Album Reviews</h2>
			<div class="grid">
				<?php $albums = new WP_Query( array( 'post_type' => 'albums', 'posts_per_page' => 16 ) ); ?>
				<?php while ( $albums->have_posts() ) : $albums->the_post(); ?>
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
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>