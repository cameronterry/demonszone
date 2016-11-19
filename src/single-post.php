<?php get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'dz-news-feature' ); ?>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php if ( comments_open() ) : ?>
				<?php // ?>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
	<aside class="sidebar">
	</aside>
<?php get_footer(); ?>
