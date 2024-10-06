<div class="gpt-contact-info">
	<?php if ( ! empty( $settings['icon'] ) ) : ?>
		<div class="gpt-contact-info__icon">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
		</div>
		<!-- /.gpt-contact-info__icon -->
	<?php endif; ?>

	<?php if ( ! empty( $settings['contact_info'] ) ) :
		// Press Enter to create a new line with p tag
		$info = nl2br( $settings['contact_info'] );
		$info = str_replace( '<br />', '<p>', $info );
		?>
		<div class="gpt-contact-info__info">
			<?php if ( ! empty( $settings['title'] ) ) : ?>
				<h3 class="gpt-contact-info__title">
					<?php echo $settings['title']; ?>
				</h3>
			<?php endif; ?>

			<?php if( ! empty( $info )) : ?>
				<p>
					<?php if( !empty( $settings['link']['url'] )) : ?>
						<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
					<?php endif; ?>
						<?php echo $info; ?>
					<?php if( !empty( $settings['link']['url'] )) : ?>
						</a>
					<?php endif; ?>
				</p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
