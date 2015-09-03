<?php get_header(); ?>
	<main class="main-content all-listing clearfix" role="main">
		<h1><?php dz_the_archive_title(); ?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'listing', get_post_type() ); ?>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>