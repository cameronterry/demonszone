<?php get_header(); ?>
	<?php
		$template = get_theme_mod( 'article_template_type', 'content-one' );

		if ( in_array( $template, array( 'content-one', 'content-two' ) ) ) {
			get_template_part( 'template-parts/news', $template );
		}
		else if ( 'content-two-admin' === $template && current_user_can( 'edit_theme_options' ) ) {
			get_template_part( 'template-parts/news', 'content-two' );
		}
		else {
			get_template_part( 'template-parts/news', 'content-one' );
		}
	?>
<?php get_footer(); ?>
