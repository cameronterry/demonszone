<?php get_header(); ?>
	<main class="main-content single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php

				/** Preparation for Article Elements. */
				$related_albums = dz_get_related_albums();

			?>
			<article <?php post_class( 'article' ); ?>>
				<p class="category"><?php the_category( ',' ); ?></p>
				<?php if ( has_post_thumbnail() && empty( get_video_thumbnail() ) ) : ?>
					<div class="thumbnail"><?php the_post_thumbnail( 'news-thumb-large' ); ?></div>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<p class="attribution">
					Posted on <time><?php the_date(); ?></time>
					by <?php the_author_posts_link(); ?>
				</p>
				<div class="copy">
					<?php the_content(); ?>
					<p><?php the_terms( get_the_ID(), 'artist', 'Artist(s) : ' ); ?></p>
				</div>
			</article>

			<aside class="col">
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
										<p class="rating"><?php dz_album_rating( '' ); ?></p>
									</div>
								</div>
							</a>
						</article>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</aside>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>