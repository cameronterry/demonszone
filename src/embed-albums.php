<?php get_header( 'embed' ); ?>
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div <?php post_class( 'wp-embed' ); ?>>
				<?php
				$thumbnail_id = 0;

				if ( has_post_thumbnail() ) {
					$thumbnail_id = get_post_thumbnail_id();
				}

				if ( 'attachment' === get_post_type() && wp_attachment_is_image() ) {
					$thumbnail_id = get_the_ID();
				}
				?>

				<p class="wp-embed-heading">
					<a href="<?php the_permalink(); ?>?utm_source=embed" target="_top">
						Review : <?php the_title(); ?>
					</a>
				</p>

				<?php if ( $thumbnail_id ) : ?>
					<div class="wp-embed-featured-image square">
						<a href="<?php the_permalink(); ?>?utm_source=embed" target="_top">
							<?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
						</a>
					</div>
				<?php endif; ?>

				<div class="wp-embed-excerpt">
					<p style="font-weight:bold;"><?php the_terms( get_the_ID(), 'artist', 'Artist : ', ', ' ); ?></p>
					<p>
						<?php echo( wp_trim_words( get_the_excerpt(), 40, '...' ) ); ?>
						<a href="<?php the_permalink(); ?>?utm_source=embed" style="font-style:italic;">Click here to read the full review.</a>
					</p>
					<?php dz_purchase_the_links(); ?>
				</div>

				<div class="wp-embed-footer">
					<?php dz_the_embed_site_title() ?>

					<div class="wp-embed-meta">
						Rating : <?php dz_the_rating(); ?>
						<?php print_embed_sharing_button(); ?>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer( 'embed' ); ?>
