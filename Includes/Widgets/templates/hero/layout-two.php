<div <?php echo $this->get_render_attribute_string( 'wrapper' ) ?>>
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-lg-4 gpt-order-2">
				<div class="banner__content">

					<?php if ( ! empty( $settings['subtitle'] ) ) : ?>
						<h3 <?php echo $this->get_render_attribute_string( 'subtitle'); ?>>
							<?php echo $settings['subtitle']; ?>
						</h3>
					<?php endif ?>


					<?php if ( ! empty( $settings['title'] ) ) : ?>
						<h1 <?php echo $this->get_render_attribute_string( 'title'); ?>>
							<?php echo $settings['title']; ?>
							<?php if ( ! empty( $settings['designation'] ) ) : ?>
								<span class="banner__designation">
									<?php echo $settings['designation']; ?>
								</span>
							<?php endif ?>
						</h1>
					<?php endif ?>

					<?php if ( ! empty( $settings['description'] ) ) : ?>
						<p <?php echo $this->get_render_attribute_string( 'description'); ?>>
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
							<i class="fa-solid fa-download"></i>
						</a>
					<?php endif; ?>

				</div>
			</div>

			<div class="col-lg-5">
				<div class="banner__feature-image text-center pr">
					<?php if ( ! empty( $settings['feature_image_two']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $settings['feature_image_two']['url'] ); ?>" class="wow fadeInUp"  data-wow-delay="0.5s" alt="<?php echo esc_attr( $settings['title'] ); ?>">
					<?php endif; ?>

					<span class="circle-shape"></span>
					<span class="progress-shape">
						<img src="<?php echo plugins_url(  ) . '/gpt-news-core/Includes/widgets/images/banner/progress-shape.png' ?>" alt="">
					</span>
				</div>
				<!-- /.banner-feature-image -->
			</div>
			<!-- /.col-md-6 -->

			<?php if ( ! empty( $settings['info_list'] ) ) : ?>
				<div class="col-lg-3">
					<ul class="banner__info-list">
						<?php foreach ( $settings['info_list'] as $item ) : ?>
							<li class="banner__info-list-wrap wow fadeInUp" data-wow-delay=".5s">
								<?php if ( ! empty( $item['info_count'] ) ) : ?>
									<div class="banner__info-list-count">
										<div>
										<span class="odometer" data-count="<?php echo $item['info_count']; ?>">
										</div>
										<?php if ( ! empty( $item['info_suffix'] ) ) : ?>
											<span><?php echo $item['info_suffix']; ?></span>
										<?php endif ?>
									</div>
								<?php endif ?>

								<?php if ( ! empty( $item['info_title'] ) ) : ?>
									<h3 class="banner__info-list-title">
										<?php echo $item['info_title']; ?>
									</h3>
								<?php endif ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>

		</div>
	</div>

</div>
