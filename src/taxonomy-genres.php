<?php get_header(); ?>
	<div id="primary" class="grid-area">
		<main id="main" class="site-main clear" role="main">
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/cell', 'albums' ); ?>
			<?php endwhile; ?>
		</main>
		<?php the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'twentysixteen' ),
			'next_text'          => __( 'Next page', 'twentysixteen' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
		) ); ?>
	</div>
<?php get_footer(); ?>
