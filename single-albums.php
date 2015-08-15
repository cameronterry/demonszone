<?php get_header(); ?>
	<main class="main-content single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php

				/** Preparation for Article Elements. */
				$related_albums = dz_get_related_albums();
				$albums_by_genres = dz_get_albums_by_genres();


			?>
			<article <?php post_class( 'article' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail"><?php the_post_thumbnail( 'album-medium' ); ?></div>
				<?php endif; ?>
				<h1><?php the_title(); ?></h1>
				<p class="attribution">
					Posted on <time><?php the_date(); ?></time>
					by <?php the_author_posts_link(); ?>
				</p>
				<div class="copy">
					<?php the_content(); ?>
				</div>
				<p class="rating"><?php dz_album_rating(); ?></p>
				<h2>Track Listing :</h2>
				<?php if ( have_rows( 'tracklisting' ) ) : ?>
					<ol class="tracklisting">
						<?php while ( have_rows( 'tracklisting' ) ) : the_row(); ?>
							<li><?php the_sub_field( 'song_name' ); ?></li>
						<?php endwhile; ?>
					</ol>
				<?php endif; ?>
			</article>

			<aside class="col">
				<h2 class="heading heading-with-container">Album Details</h2>
				<div class="heading-container">
					<p><?php the_terms( get_the_ID(), 'artist', 'Artist : ', ', ' ); ?></p>
					<p><?php the_terms( get_the_ID(), 'genres', 'Genres : ', ', ' ); ?></p>
					<p>Release Date : <?php dz_album_release_date(); ?></p>
				</div>
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

			<?php if ( $albums_by_genres->have_posts() ) : ?>
				<aside class="col">
					<h2 class="heading">More Albums:</h2>
					<?php while ( $albums_by_genres->have_posts() ) : $albums_by_genres->the_post(); ?>
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
				</aside>
			<?php endif; ?>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>