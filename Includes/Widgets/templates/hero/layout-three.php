<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>

	<div class="container">
		<div class="row pr align-items-center">
			<div class="col-md-6 gpt-order-2">
				<div class="banner__content">


					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<h3 <?php echo $this->get_render_attribute_string( 'subtitle'); ?>>
							<?php echo $settings['subtitle']; ?>
						</h3>
					<?php endif; ?>

					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title'); ?>>
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="banner__description">
							<?php echo $settings['description']; ?>
						</p>
					<?php endif ?>

					<div class="button-container d-flex align-items-center gap-2 mt-5">

						<?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
							<a <?php $this->print_render_attribute_string( 'button' ); ?>>
								<?php echo $settings['btn_text'] ?>
							</a>
						<?php endif; ?>

						<?php if ( $settings['social_icons'] ) : ?>
							<ul class="banner__social-links">
								<?php foreach ( $settings['social_icons'] as $item ) : ?>
									<li class="wow" data-wow-delay=".5s">
										<a href="<?php echo esc_url( $item['social_link']['url'] ); ?>" target="_blank">
											<?php  \Elementor\Icons_Manager::render_icon( $item['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>

				</div>
			</div>

			<div class="col-md-6">
				<div class="banner__feature-image text-center pr">
					<?php if ( ! empty( $settings['feature_image_two']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['feature_image_two']['url'] ); ?>" class="wow fadeInUp"  data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
					<?php endif; ?>
				</div>
				<!-- /.banner-feature-image -->
			</div>


		</div>

		<div class="intro_text">
			<svg viewBox="0 0 1320 300">
				<text x="50%" y="50%" text-anchor="middle" class="animate-stroke">
					HI
				</text>
			</svg>
		</div>
	</div>

</div>
