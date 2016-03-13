<?php get_header(); ?>
	<main class="main-content single-news clearfix" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="article-news">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php dz_share_buttons(); ?>
				</header>
				<div class="post-thumbnail">
					<?php the_post_thumbnail( 'news-thumb-xlarge' ); ?>
				</div>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php dz_share_buttons(); ?>
				</div>
				<div class="entry-footer">
					<span class="byline">
						<span class="author vcard">
							<a class="url fn n" href="<?php echo( esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ); ?>"><?php the_author(); ?></a>
						</span>
					</span>
					<span class="posted-on">
						<time class="entry-date published updated" datetime="<?php echo( esc_attr( get_the_date( 'c' ) ) ); ?>">
							<a href="<?php the_permalink(); ?>"><?php echo( get_the_date() ); ?></a>
						</time>
					</span>
				</div>
			</article>
		<?php endwhile; ?>
	</main>
	<?php get_sidebar( 'news-sidebar' ); ?>
<?php get_footer(); ?>
