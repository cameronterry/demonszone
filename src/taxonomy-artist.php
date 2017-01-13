<?php get_header(); ?>
	<div id="primary" class="home grid-area">
		<main id="main" class="site-main clear" role="main">
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'post' ); ?>
			<?php endwhile; ?>
		</main>

		<?php $albums = dz_get_albums_by_artist( get_queried_object_id(), null, true ); ?>
		<?php if ( $albums->have_posts() ) : ?>
			<main class="site-main clear">
				<header class="page-header">
					<h2 class="page-title"><?php echo( single_term_title( '', false ) ); ?> - Reviews :</h2>
				</header><!-- .page-header -->

				<?php while ( $albums->have_posts() ) : $albums->the_post(); ?>
					<?php get_template_part( 'template-parts/cell', 'albums' ); ?>
				<?php endwhile; ?>
			</main>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>
