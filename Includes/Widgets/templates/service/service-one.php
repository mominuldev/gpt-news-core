<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="pps-service__count">
		<?php if ( $settings['count'] ): ?>
			<?php printf( '%s', $settings['count'] ); ?>
		<?php endif; ?>
	</div>

	<div class="pps-service__content">
		<?php if ( $settings['title'] ): ?>
			<h4 class="pps-service__title">
				<?php printf( '%s', $settings['title'] ); ?>
			</h4>
		<?php endif; ?>

		<?php if ( $settings['description'] ): ?>
			<p class="pps-service__description">
				<?php printf( '%s', $settings['description'] ); ?>
			</p>
		<?php endif; ?>
	</div>

	<?php if ( !empty( $settings['button_link'])): ?>
		<a <?php echo $this->get_render_attribute_string( 'btn_link' ); ?>>
			<i class="ri-arrow-right-up-line"></i>
		</a>
	<?php endif; ?>
</div>
<!-- /.pps-service -->