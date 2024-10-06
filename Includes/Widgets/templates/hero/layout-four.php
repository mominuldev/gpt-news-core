<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="banner__container">
		<div class="banner__content-wrapper">

			<div class="banner--column-left">
				<div class="banner__content">
					<?php
					if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
							<?php echo $settings['title']; ?>
						</h1>
					<?php endif ?>

					<div class="banner__info">
						<?php if ( ! empty( $settings['location'] ) ) : ?>
							<div class="banner__info-item">
								<i class="ri-map-pin"></i>
								<?php echo $settings['location']; ?>
							</div>
						<?php endif ?>

						<?php if ( ! empty( $settings['availability'] ) ) : ?>
							<div class="banner__info-item">
								<i class="ri-time-line"></i>
								<?php echo $settings['availability']; ?>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>


			<div class="banner--column-center">
				<div class="banner__image">

					<div class="banner__circle">
						<canvas id="gradient-canvas" width="800"></canvas>
					</div>
					<!-- /.banner__circle-shape -->

					<div class="banner__circle-stroke"></div>

					<?php if ( ! empty( $settings['feature_image_two']['url'] ) ) : ?>
						<div class="banner__image-wrap">
							<img src="<?php echo esc_url( $settings['feature_image_two']['url'] ); ?>"
							 alt="<?php echo esc_attr( $settings['title'] ); ?>" class="banner__profile-img banner__image-anime">
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="banner--column-right">
				<div class="banner__content-right">
					<?php if ( ! empty( $settings['designation'] ) ) : ?>
						<h2 class="banner__designation h1">
							<?php echo $settings['designation']; ?>
						</h2>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>

</div>
