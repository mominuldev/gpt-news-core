<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="gpt-experience__icon">
		<?php if ( 'icon' === $settings['icon_type'] ): ?>
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		<?php elseif ( 'image' === $settings['icon_type'] && ! empty( $settings['image']['url'] ) ): ?>
			<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['title'] ); ?>">
		<?php endif; ?>
	</div>

	<div class="gpt-experience__content">
		<?php if ( $settings['year'] ): ?>
			<p class="gpt-experience__year">
				<?php printf( '%s', $settings['year'] ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $settings['designation'] ): ?>
			<h3 class="gpt-experience__designation">
				<?php printf( '%s', $settings['designation'] ); ?>
			</h3>
		<?php endif; ?>

		<?php if ( $settings['company_name'] ): ?>
			<p class="gpt-experience__company">
				<?php printf( '%s', $settings['company_name'] ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
<!-- /.gpt-experience -->