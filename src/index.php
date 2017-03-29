<?php get_header(); ?>
	<div id="primary" class="home grid-area">
		<main id="main" class="site-main clear" role="main">
			<header class="page-header">
				<h2 class="page-title">Newest Updates:</h2>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'post' ); ?>
			<?php endwhile; ?>
		</main>

		<?php $section_posts = dz_get_albums( 8 ); ?>
		<main class="site-main clear">
			<header class="page-header">
				<h2 class="page-title">Latest Reviews :</h2>
			</header><!-- .page-header -->

			<?php while ( $section_posts->have_posts() ) : $section_posts->the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'albums' ); ?>
			<?php endwhile; ?>
		</main>

		<?php

			dz_the_section_category( 'tour-dates', 12 );
			dz_the_section_category( 'releases', 12 );
		?>

		<?php $section_posts = dz_get_gigs( 8 ); ?>
		<main class="site-main clear">
			<header class="page-header">
				<h2 class="page-title">
					<a href="<?php echo( get_post_type_archive_link( 'gigs' ) ); ?>">Gig Reviews</a> :
				</h2>
			</header><!-- .page-header -->

			<?php while ( $section_posts->have_posts() ) : $section_posts->the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'post' ); ?>
			<?php endwhile; ?>
		</main>

		<?php

			dz_the_section_category( 'videos', 12 );

		?>

		<?php $section_posts = dz_get_albums_by_rating( 10, 8 ); ?>
		<main class="site-main clear">
			<header class="page-header">
				<h2 class="page-title">10 / 10 :</h2>
			</header><!-- .page-header -->

			<?php while ( $section_posts->have_posts() ) : $section_posts->the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'albums' ); ?>
			<?php endwhile; ?>
		</main>
	</div>
<?php get_footer(); ?>
