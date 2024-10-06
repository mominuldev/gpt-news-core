<div class="gpt-testimonial-wrapper">
	<div class="row">
		<div class="col-md-4">
			<div class="section-heading">
				<?php if ( !empty( $settings['sub_title'] ) ) : ?>
					<h3 class="subtitle"><?php echo esc_html( $settings['sub_title'] ); ?></h3>
				<?php endif; ?>
				<?php if ( !empty( $settings['title'] ) ) : ?>
					<h2 class="section-title">
						<?php echo esc_html( $settings['title'] ); ?>
						<?php if ( !empty( $settings['highlight_title'] ) ) : ?>
							<span class="highlight-title"><?php echo esc_html( $settings['highlight_title'] ); ?></span>
						<?php endif; ?>
					</h2>
				<?php endif; ?>

				<?php if ( !empty( $settings['description'] ) ) : ?>
					<p class="section-desc"><?php echo esc_html( $settings['description'] ); ?></p>
				<?php endif; ?>

			</div>

			<div class="gpt-testimonial__control">
				<?php if ($settings['navigation'] == 'yes') : ?>
					<div class="gpt-testimonial__control--prev">
						<i class="ri-arrow-left-up-line"></i>
					</div>

					<div class="gpt-testimonial__control--next ">
						<i class="ri-arrow-right-up-line"></i>
					</div>
				<?php endif; ?>
			</div>
			<!-- /.dmt-slider-control -->
		</div>

		<div class="col-md-8">
			<div <?php $this->print_render_attribute_string('wrapper'); ?>>
				<div class="swiper-wrapper">
					<?php if (is_array($testimonials)) :
						foreach ($testimonials as $testimonial) : ?>
							<?php
							if ($testimonial['image'] != '') {
								$avatar = $testimonial['image']['url'];
							}
							?>
							<div class="swiper-slide">
								<div <?php $this->print_render_attribute_string('testimonial'); ?>>
									<div class="gpt-testimonial__header">
										<?php if (!empty($avatar)): ?>
											<div class="gpt-testimonial__avatar">
												<img class="author-image" src="<?php echo esc_url($avatar) ?>"
													 alt="<?php echo esc_attr($testimonial['name']) ?>" height="70" width="70">
											</div>
										<?php endif; ?>
									</div>
									<!-- /.testimonial-content-inner -->

									<div class="gpt-testimonial__content">
										<?php if (!empty($testimonial['review_content'])) : ?>
											<p class="gpt-testimonial__review">
												<?php echo $testimonial['review_content']; ?>
											</p>
										<?php endif; ?>

										<div class="gpt-testimonial__bio-wrapper">
											<?php
											$rating = $testimonial['rating'];
											$this->add_render_attribute('star-rating', 'class', 'gpt-star-rating gpt-star-' . esc_attr($rating));

											$rating_markup = "<div class='gpt-star-rating gpt-star-" . $rating . "'>\n";
											$rating_markup .= "<span class=\"gpt-star-1 fa-star\"></span>\n";
											$rating_markup .= "<span class=\"gpt-star-2 fa-star\"></span>\n";
											$rating_markup .= "<span class=\"gpt-star-3 fa-star\"></span>\n";
											$rating_markup .= "<span class=\"gpt-star-4 fa-star\"></span>\n";
											$rating_markup .= "<span class=\"gpt-star-5 fa-star\"></span>\n";
											$rating_markup .= "</div>";

											echo $rating_markup;
											?>
											<?php if (!empty($testimonial['name'])) : ?>
												<h4 class="gpt-testimonial__name"><?php echo $testimonial['name']; ?></h4>
											<?php endif; ?>

											<?php if (!empty($testimonial['designation'])) : ?>
												<span class="gpt-testimonial__designation"><?php echo $testimonial['designation']; ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<!-- /.swiper-slide -->
						<?php
						endforeach;
					endif;
					?>
				</div>
				<?php if ($settings['pagination'] == 'yes') { ?>
					<div class="testimonial-pagination swiper-pagination"></div>
				<?php } ?>
			</div>
			<!-- /.swiper-wrapper -->

		</div>
	</div>



</div>
<!-- /.gpt-testimonial-wrapper -->
