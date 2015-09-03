<?php get_header(); ?>
	<main class="main-content all-listing clearfix" role="main">
		<h1>Search Results : "<?php echo( $_GET['s'] ); ?>"</h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'listing', get_post_type() ); ?>
		<?php endwhile; ?>
		<div id="content"></div>
	</main>
<?php get_footer(); ?>