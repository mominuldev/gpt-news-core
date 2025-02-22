<div class="col-lg-<?php echo esc_attr( $settings['column'] ); ?> col-md-6 col-sm-6">
	<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
		<div class="pps-skill__image">
			<?php if ( $item['image']['url'] ): ?>
				<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['title'] ); ?>">
			<?php endif; ?>

			<?php if ( $item['percent'] ): ?>
				<div class="pps-skill__percent">
					<?php printf( '%s', $item['percent'] ); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="pps-skill__content">
			<?php if ( $item['title'] ): ?>
				<h4 class="pps-skill__title">
					<?php printf( '%s', $item['title'] ); ?>
				</h4>
			<?php endif; ?>
		</div>
	</div>
	<!-- /.pps-skill -->
</div>
