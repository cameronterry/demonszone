<?php get_header(); ?>
	<main class="main-content single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( array( 'article', 'page' ) ); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="copy">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>