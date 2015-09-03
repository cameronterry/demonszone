<?php get_header(); ?>
	<main class="main-content all-listing clearfix" role="main">
		<h1><?php echo( single_term_title() ); ?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( array( 'article', 'clearfix' ) ); ?>>
				<h2>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="thumbnail"><?php the_post_thumbnail( 'news-thumb' ); ?></div>
					<?php endif; ?>
					<?php the_excerpt(); ?>
					<?php the_tags( '<p>', ', ', '</p>' ); ?>
					<p class="attribution">
						Posted on <time><?php echo( get_the_date() ); ?></time>
						by <?php the_author_posts_link(); ?>
					</p>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>