<?php get_header(); ?>
	<main class="main-content single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php

				/** Preparation for Article Elements. */
				$related_albums = dz_get_related_albums( true );
				$albums_by_genres = dz_get_albums_by_genres();

			?>
			<article <?php post_class( 'article' ); ?> role="article" itemscope itemtype="http://schema.org/Review">
				<?php dz_album_schema_meta(); ?>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="thumbnail"><?php the_post_thumbnail( 'album-medium' ); ?></div>
				<?php endif; ?>
				<h1 class="entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/MusicRelease">
					<span itemprop="name"><?php the_title(); ?></span>
				</h1>
				<p class="attribution">
					Posted on <time><?php the_date(); ?></time>
					by <span class="author vcard"><?php dz_album_the_author(); ?></span>
				</p>
				<div class="copy">
					<?php dz_share_buttons(); ?>
					<div itemprop="reviewBody">
						<?php the_content(); ?>
					</div>
					<?php dz_share_buttons(); ?>
				</div>
				<p class="rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating"><?php dz_album_rating(); ?></p>
				<div class="album-tracks">
					<h2>Track Listing :</h2>
					<?php if ( have_rows( 'tracklisting' ) ) : ?>
						<ol class="tracklisting">
							<?php while ( have_rows( 'tracklisting' ) ) : the_row(); ?>
								<li><?php the_sub_field( 'song_name' ); ?></li>
							<?php endwhile; ?>
						</ol>
					<?php endif; ?>
				</div>
			</article>

			<aside class="col">
				<h2 class="heading heading-with-container">Album Details</h2>
				<div class="heading-container">
					<p><?php the_terms( get_the_ID(), 'artist', 'Artist : ', ', ' ); ?></p>
					<p><?php the_terms( get_the_ID(), 'genres', 'Genres : ', ', ' ); ?></p>
					<p>Release Date : <?php dz_album_release_date(); ?></p>
				</div>

				<div rel="advert" data-sizes="300x250,300x600"></div>

				<?php if ( false === empty( $related_albums ) && $related_albums->have_posts() ) : ?>
					<h2 class="heading">Related Albums:</h2>
					<?php while ( $related_albums->have_posts() ) : $related_albums->the_post(); ?>
						<?php get_template_part( 'content', 'albums' ); ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>
			</aside>

			<?php if ( false === empty( $albums_by_genres ) && $albums_by_genres->have_posts() ) : ?>
				<aside class="col">
					<h2 class="heading">More Albums:</h2>
					<?php while ( $albums_by_genres->have_posts() ) : $albums_by_genres->the_post(); ?>
						<?php get_template_part( 'content', 'albums' ); ?>
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

					<div class="divider"></div>

					<div rel="advert" data-sizes="300x250,300x600"></div>
				</aside>
			<?php endif; ?>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>