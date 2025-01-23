<div class="pps-testimonial-wrapper">

	<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

		<?php if ( $settings['navigation'] == 'yes' ) : ?>
			<div class="testimonial-prev">
				<i class="fas fa-chevron-left"></i>
			</div>
		<?php endif; ?>
		<div class="swiper-wrapper">
			<?php if ( is_array( $testimonials ) ) :
				foreach ( $testimonials as $testimonial ) : ?>
					<?php
					if ( $testimonial['image'] != '' ) {
						$avatar = $testimonial['image']['url'];
					}
					?>
					<div class="swiper-slide">
						<div <?php $this->print_render_attribute_string( 'testimonial' ); ?>>

							<div class="testimonial-info-wrapper">
								<div class="testimonial-content-wrapper">
									<?php if ( ! empty( $avatar ) ): ?>
										<div class="avatar">
											<img class="author-image" src="<?php echo esc_url( $avatar ) ?>"
												 alt="<?php echo esc_attr( $testimonial['name'] ) ?>" height="70" width="70">
										</div>
									<?php endif; ?>

									<div class="bio-wrapper">
										<?php if ( ! empty( $testimonial['name'] ) ) : ?>
											<h4 class="name"><?php echo $testimonial['name']; ?></h4>
										<?php endif; ?>

										<?php if ( ! empty( $testimonial['designation'] ) ) : ?>
											<span class="designation"><?php echo $testimonial['designation']; ?></span>
										<?php endif; ?>
									</div>
								</div>
								<!-- /.testimonial-cotent-inner -->

								<?php
								$rating = $testimonial['rating'];
								$this->add_render_attribute( 'star-rating', 'class', 'pps-star-rating pps-star-' . esc_attr( $rating ) );

								$rating_markup = "<div class='pps-star-rating pps-star-" . $rating . "'>\n";
								$rating_markup .= "<span class=\"pps-star-1 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"pps-star-2 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"pps-star-3 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"pps-star-4 fa-star\"></span>\n";
								$rating_markup .= "<span class=\"pps-star-5 fa-star\"></span>\n";
								$rating_markup .= "</div>";

								echo $rating_markup;
								?>
							</div>
							<!-- /.testimonial-info-wrapper -->


							<div class="testimonial-separator"></div>


							<?php if ( ! empty( $testimonial['review_content'] ) ) : ?>
								<p>
									<?php echo $testimonial['review_content']; ?>
								</p>
							<?php endif; ?>

						</div>
					</div>
					<!-- /.swiper-slide -->
				<?php
				endforeach;
			endif;
			?>
		</div>

		<?php if ( $settings['navigation'] == 'yes' ) : ?>
			<div class="testimonial-next ">
				<i class="fas fa-chevron-right"></i>
			</div>
		<?php endif; ?>
	</div>
	<!-- /.swiper-wrapper -->
	<?php if ( $settings['pagination'] == 'yes' ) { ?>
		<div class="testimonial-pagination swiper-pagination"></div>
	<?php } ?>

</div>
<!-- /.pps-testimonial-wrapper -->
