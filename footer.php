		</div>
	</div>
	<div class="sb-slidebar sb-left sb-style-push main-navigation">
		<div class="logo">
			<a href="<?php echo( home_url( '/' ) ); ?>">
				<img src="<?php echo( get_template_directory_uri() ); ?>/assets/img/dz-logo-495x295.png" />
			</a>
		</div>
		<form action="<?php echo( home_url( '/' ) ); ?>" class="search-form" method="get">
			<input id="s" name="s" class="search-box" placeholder="Search..." type="text" value="" />
		</form>
    	<?php wp_nav_menu( array( 'menu' => 'primary' ) ); ?>
    </div>
	<footer class="footer">
		<p>Copyright DemonsZone <?php echo( date( 'Y' ) ); ?>, All Rights Reserved<span class="padding"></span><a href="mailto:hello@demonszone.com">hello@demonszone.com</a></p>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>