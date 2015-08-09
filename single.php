<?php get_header(); ?>
	<main class="single clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'article' ); ?>>
				<h1><?php the_title(); ?></h1>
				<p class="attribution">
					Posted on
					<time><?php the_date(); ?></time>
					by
					<?php the_author_posts_link(); ?>
				</p>
				<?php the_content(); ?>
			</article>
			<aside class="col">
				Hello world
			</aside>
			<aside class="col">
				Hello world
			</aside>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>