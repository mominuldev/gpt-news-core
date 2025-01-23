<?php


use PixelPath\PPSPassportCore\ImageSize;

$ant = 0.5;

while ( $pps_query->have_posts() ) :
	$pps_query->the_post();

	$reveal = $settings['reveal_animation'];

	$grid_classes = '';
	$animation    = '';

	if ( ! empty( $settings['grid_animation'] ) ) {
		$animation .= $settings['grid_animation'] . ' wow ';
	}

	$classes = array( "pps-project grid-item $animation" );

	if ( 'yes' == $reveal ) {
		$grid_classes .= 'overlay_effect ';
	}

	if ( 'yes' == $settings['tilt-effect'] ) {
		$grid_classes .= 'tilt-effect ';
	}

	if ( 'yes' === $settings['show_caption'] ) {
		$grid_classes .= 'pps-project--caption ';
	}


	if ( ! empty( $settings['overlay_style'] ) ) {
		$grid_classes .= $settings['overlay_style'];
	}

	?>
	<figure <?php post_class( implode( ' ', $classes ) ); ?> data-wow-delay="<?php echo esc_attr( $ant ); ?>s">
		<div class="pps-project__wrapper pps-box <?php echo $grid_classes ?>">
			<div class="pps-project__thumbnail-wrapper pps-image">
				<div class="pps-project__thumbnail">
					<a href="<?php echo the_permalink(); ?>" class="post-permalink link-secret">
						<?php if ( has_post_thumbnail() ) { ?>
							<?php $size = ImageSize::elementor_parse_image_size( $settings, '480x480' ); ?>
							<?php ImageSize::the_post_thumbnail( array( 'size' => $size ) ); ?>
						<?php } ?>

						<?php if ( 'overlay-one' == $settings['overlay_style'] ) : ?>
							<span class="pps-project__permalink"><?php echo 'Case <br> Studies' ?></span>
						<?php endif; ?>
					</a>
				</div>


				<?php if ( ! empty( $settings['overlay_style'] ) ) : ?>
					<?php if ( 'yes' != $settings['show_caption'] ) : ?>
						<div class="pps-project__info">
							<h3 class="pps-project__title" data-hover="<?php the_title(); ?>">
								<a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="pps-project__cat-wrapper">
								<?php
								$terms = get_the_terms( get_the_ID(), 'project_category' );

								if ( $terms && ! is_wp_error( $terms ) ) :
									foreach ( $terms as $term ) { ?>
										<span class="pps-project__cat-item"><?php echo $term->name; ?></span>
									<?php } ?>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<?php if ( 'yes' === $settings['show_caption'] ) : ?>
				<div class="pps-project__info-caption">
					<h3 class="pps-project__info-title">
						<a href="<?php the_permalink() ?>"><span><?php the_title(); ?></span></a>
					</h3>

					<div class="pps-project__cat">
						<?php
						$terms = get_the_terms( get_the_ID(), 'project_category' );

						if ( $terms && ! is_wp_error( $terms ) ) :
							foreach ( $terms as $term ) { ?>
								<span class="pps-project__info-cat-item"><?php echo $term->name; ?></span>
							<?php } ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</figure>
	<?php

	$ant = $ant + 0.1;
endwhile;
?>