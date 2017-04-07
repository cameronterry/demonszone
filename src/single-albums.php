<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="albums-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">Review: ', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php twentysixteen_excerpt(); ?>

				<?php twentysixteen_post_thumbnail(); ?>

				<div class="entry-content">
					<?php the_content(); ?>
					<h2>Where to buy :</h2>
					<?php

						get_template_part( 'template-parts/purchase', 'links' );

						if ( '' !== get_the_author_meta( 'description' ) ) {
							get_template_part( 'template-parts/biography' );
						}

					?>
					<h2>Track Listing :</h2>
					<?php if ( have_rows( 'tracklisting' ) ) : ?>
						<ol class="tracklisting">
							<?php while ( have_rows( 'tracklisting' ) ) : the_row(); ?>
								<li><?php the_sub_field( 'song_name' ); ?></li>
							<?php endwhile; ?>
						</ol>
					<?php endif; ?>
					<?php

						dz_the_related_posts();

					?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<?php dz_the_entry_meta(); ?>
					<span class="artist-list"><?php the_terms( get_the_ID(), 'artist', 'Artist : ', ', ' ); ?></span>
					<span class="genres-list"><?php the_terms( get_the_ID(), 'genres', 'Genres : ', ', ' ); ?></span>
					<span class="labels-list"><?php the_terms( get_the_ID(), 'record_labels', 'Labels : ', ', ' ); ?></span>
					<span class="labels-list"><?php dz_purchase_the_links(); ?></span>
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</footer><!-- .entry-footer -->
			</article><!-- #post-## -->

			<?php if ( comments_open() || get_comments_number() ) {
				comments_template();
			} ?>
		<?php endwhile;?>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
