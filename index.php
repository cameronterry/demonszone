<?php

	$first = true;

?>
<?php get_header(); ?>
	<main class="main-content clearfix" role="main">
		<section class="news clearfix">
			<h2>Headlines</h2>
			<?php if ( have_posts() ) : the_post(); ?>
				<article <?php post_class( array( 'feature' ) ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'homepage-feature' ); ?></a>
					<?php endif; ?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</article>
				<?php while ( have_posts() ) : the_post(); ?>
					<article <?php post_class( array( 'article', ( $first ? 'first' : '' ) ) ); ?>>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</article>
				<?php $first = false; endwhile; ?>
			<?php endif; ?>
		</section>
		<?php if ( is_front_page() ) : ?>
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
		<?php endif; ?>
	</main>
<?php get_footer(); ?>