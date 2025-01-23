<div class="pps__post-list pps__post-list--<?php echo esc_attr($settings['layout']); ?>">

	<?php if (has_post_thumbnail()): ?>
		<div class="pps__feature-image">
			<?php the_post_thumbnail('pps-blog-list_300x185', array('class' => 'img-fluid')) ?>
		</div>
	<?php endif; ?>

	<div class="pps-post__date-meta">
		<?php PPS_Theme_Helper::pps_posted_date(); ?>
	</div>

	<div class="pps__blog-content">
		<div class="pps__post-list-title-wrapper">
			<h3 class="pps__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>

		<p class="pps-post__entry-content">
			<?php echo PPS_Theme_Helper::pps_excerpt($settings['content_length']); ?>
		</p>
	</div>
</div>



