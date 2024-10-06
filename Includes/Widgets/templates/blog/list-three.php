<div class="gpt__post-list gpt__post-list--<?php echo esc_attr($settings['layout']); ?>">

	<?php if (has_post_thumbnail()): ?>
		<div class="gpt__feature-image">
			<?php the_post_thumbnail('gpt-blog-list_300x185', array('class' => 'img-fluid')) ?>
		</div>
	<?php endif; ?>

	<div class="gpt-post__date-meta">
		<?php Gpt_Theme_Helper::gpt_posted_date(); ?>
	</div>

	<div class="gpt__blog-content">
		<div class="gpt__post-list-title-wrapper">
			<h3 class="gpt__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</div>

		<p class="gpt-post__entry-content">
			<?php echo Gpt_Theme_Helper::gpt_excerpt($settings['content_length']); ?>
		</p>
	</div>
</div>



