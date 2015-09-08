<?php get_header(); ?>
	<main class="main-content clearfix" role="main">
		<section class="albums clearfix">
			<h1>Collections : <?php single_term_title(); ?></h1>
			<div class="grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'albums' ); ?>
				<?php endwhile; ?>
			</div>
			<div id="content" class="grid"></div>
		</section>
	</main>
<?php get_footer(); ?>