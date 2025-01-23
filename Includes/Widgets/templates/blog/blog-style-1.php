<div class="blog-grid blog-grid--two">
	<div class="blog-grid__image">
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
			} else { ?>
				<img src="https://via.placeholder.com/410x290" alt="Placeholder">
			<?php } ?>
		</a>
	</div>
	<div class="blog-grid__content">
		<?php if( $meta_show == 'yes' ) { ?>
			<ul class="entry-meta">
				<li>
					<?php \PPS_Theme_Helper::post_author_by(); ?>
				</li>
				<li>
					<i class="ri-calendar-2-line"></i>
					<?php \PPS_Theme_Helper::pps_posted_on(); ?>
				</li>
			</ul><!-- .entry-meta -->
		<?php } ?>


		<h3 class="blog-grid__title blog-title-hover">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if ( $settings['excerpt_show'] ) : ?>
			<div class="blog-grid__excerpt">
				<?php echo wp_trim_words( get_the_content(), $settings['content_length'], '...' ); ?>
			</div>
		<?php endif; ?>


		<?php if ( $settings['readmore'] ) { ?>
			<a href="<?php the_permalink(); ?>" class="read-more"><?php echo $settings['readmore']; ?> <i class="ri-arrow-right-line"></i> </a>
		<?php } ?>
	</div>
</div>