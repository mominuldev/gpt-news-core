<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="gpt-service__count">
		<?php if ( $settings['count'] ): ?>
			<?php printf( '%s', $settings['count'] ); ?>
		<?php endif; ?>
	</div>

	<div class="gpt-service__content">
		<?php if ( $settings['title'] ): ?>
			<h4 class="gpt-service__title">
				<?php printf( '%s', $settings['title'] ); ?>
			</h4>
		<?php endif; ?>

		<?php if ( $settings['description'] ): ?>
			<p class="gpt-service__description">
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
<!-- /.gpt-service -->