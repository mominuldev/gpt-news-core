<div <?php echo $this->get_render_attribute_string('wrapper')?>>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 gpt-order-2">
				<div class="banner__content">


					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<h3 <?php echo $this->get_render_attribute_string( 'subtitle'); ?>>
							<?php echo $settings['subtitle']; ?>
						</h3>
					<?php endif ?>


					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title'); ?>>
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p class="wow fadeInUp banner__description" data-wow-delay=".5s">
							<?php echo $settings['description']; ?>
						</p>
					<?php endif ?>

					<?php if ( ! empty( $settings['btn_link']['url'] ) ) : ?>
						<a <?php $this->print_render_attribute_string( 'button' ); ?>>
							<?php echo $settings['btn_text'] ?>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sec_btn_link']['url'] ) ) : ?>
						<a <?php $this->print_render_attribute_string( 'secondary_button' ); ?>>
							<?php echo $settings['sec_btn_text'] ?>
						</a>
					<?php endif; ?>



				</div>
			</div>

			<div class="col-lg-5">
				<div class="banner__feature-image">
					<?php if ( ! empty( $settings['feature_image']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['feature_image']['url'] ); ?>" class="wow fadeInUp"  data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
					<?php endif; ?>
				</div>
				<!-- /.banner-feature-image -->
			</div>
			<!-- /.col-md-6 -->
		</div>
	</div>

</div>
