<div class="blog-hero-item blog-grid-three style-one">
	<div class="blog-hero-item__image">
		<a href="<?php the_permalink(); ?>">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'pps_hero_grid_800x550', array( 'alt' => get_the_title() ) );
			} else { ?>
				<img src="https://via.placeholder.com/410x290" alt="Placeholder">
			<?php } ?>
		</a>
	</div>
	<div class="blog-hero-item__content">
		<h2 class="blog-hero-item__title blog-title-hover">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<?php if ( $meta_show == 'yes' ) : ?>
			<ul class="entry-meta meta-style-two">
				<li>
					<?php PPS_Theme_Helper::pps_posted_author_avatar(); ?>
				</li>
				<li>
					<?php PPS_Theme_Helper::pps_posted_on(); ?>
				</li>
			</ul><!-- .entry-meta -->
		<?php endif; ?>
	</div>
</div>