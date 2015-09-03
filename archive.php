<?php get_header(); ?>
	<main class="main-content all-listing clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'article' ); ?>>
				<h2><?php the_title(); ?></h2>
				<div>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="thumbnail"><?php the_post_thumbnail( 'news-thumb-tiny' ); ?></div>
					<?php endif; ?>
					<?php the_excerpt(); ?>
					<p class="attribution">
						Posted on <time><?php the_date(); ?></time>
						by <?php the_author_posts_link(); ?>
					</p>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
<?php get_footer(); ?>