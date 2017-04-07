<ul class="purchase-links">
	<?php while ( have_rows( 'purchasing' ) ) : the_row(); ?>
		<li>
			<?php printf( '<a href="%4$s" rel="nofollow">Click here to buy the "%1$s" version on <strong>%2$s</strong> through %3$s.</a>', get_sub_field( 'description' ), dz_purchase_get_format(), dz_purchase_get_store(), get_sub_field( 'url' ) ); ?>
		</li>
	<?php endwhile; ?>
</ul>
