<div <?php echo $this->get_render_attribute_string('wrapper')?>>
	<div class="container">
		<div class="row align-items-center">

			<div class="col-lg-6 gpt-order-2">
				<div class="banner__content">

					<?php if ( ! empty( $settings['designation'] ) ) : ?>
						<h1 class="banner__designation">
							<?php echo $settings['designation']; ?>
						</h1>
						<h1 class="banner__designation">
							<?php echo $settings['designation_secondary']; ?>
						</h1>
					<?php endif ?>

					<div class="banner__info">
						<?php if ( ! empty( $settings['location'] ) ) : ?>
							<div class="banner__info-item">
								<?php echo $settings['location']; ?>
							</div>
						<?php endif ?>

						<?php if ( ! empty( $settings['availability'] ) ) : ?>
							<div class="banner__info-item">
								<?php echo $settings['availability']; ?> <span class="split-wrap line"><span class="split-inner"><i class="available"></i></span></span>
							</div>
						<?php endif ?>
					</div>


					<div class="banner__title-wrapper">

						<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
							<h3 <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
								<?php echo $settings['subtitle']; ?>
							</h3>
						<?php endif ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h2 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
								<?php echo $settings['title']; ?>
							</h2>
						<?php endif ?>


						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<div class="banner__description">
								<?php echo $settings['description']; ?>
							</div>
						<?php endif ?>
					</div>


				</div>
			</div>

			<div class="col-lg-6">
				<div class="banner__image">

					<div class="banner__circle">
						<canvas id="gradient-canvas" width="800"></canvas>
					</div>
					<!-- /.banner__circle-shape -->

					<div class="banner__circle-stroke"></div>

					<?php if ( ! empty( $settings['feature_image']['url'] ) ) : ?>
						<div class="banner__image-wrap">
							<img src="<?php echo esc_url( $settings['feature_image']['url'] ); ?>"
								 alt="<?php echo esc_attr( $settings['title'] ); ?>" class="banner__profile-img banner__image-anime">
						</div>
					<?php endif; ?>
				</div>
			</div>
			<!-- /.col-md-6 -->

		</div>
	</div>


</div>

<!--<div class="containerxz">-->
<!--	<div class="body">-->
<!--		<div class="line">-->
<!--			<div class="box event"></div>-->
<!--			<svg>-->
<!--				<path-->
<!--					class="path"-->
<!--					d="M0 250 Q293 250.13233423394092, 1102.5 250"-->
<!--				></path>-->
<!--			</svg>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
