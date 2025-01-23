<div class="pps__post-slider">
	<?php if ( has_post_thumbnail() ): ?>
		<div class="pps__feature-image">
			<a href="<?php echo the_permalink(); ?>">
				<?php the_post_thumbnail( 'pps_blog_grid_370x250', array( 'class' => 'img-fluid' ) ) ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="pps__blog-content">
		<?php if ( 'yes' == $settings['meta_show'] ) : ?>
			<ul class="pps__post-meta">
				<li>
					<i class="icon-user icons"></i>
					<span>By </span><?php PPS_Theme_Helper::pps_posted_by(); ?>
				</li>
				<li><i class="icon-clock icons"></i><?php PPS_Theme_Helper::pps_posted_on(); ?></li>
			</ul>
		<?php endif; ?>

		<div class="pps__entry-header">
			<h3 class="pps__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<p class="pps__entry-content">
				<?php echo PPS_Theme_Helper::pps_excerpt( $settings['content_length'] ); ?>
			</p>

			<?php if ( ! empty( $settings['readmore'] ) ) : ?>
				<a href="<?php echo the_permalink(); ?>" class="read-more-btn"><?php echo $settings['readmore']; ?> <i class="feather-arrow-right"></i></a>
			<?php endif; ?>

		</div>
	</div>
</div>
