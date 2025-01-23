<div class="pps-project__image">
	<div class="reveal">
		<?php if ( has_post_thumbnail() ): ?>
			<?php the_post_thumbnail( 'full' ); ?>
		<?php endif; ?>
	</div>
</div>
<!-- /.pps-project__image -->

<div class="pps-project__content">

	<?php if ( $settings['show_category'] == 'yes' ): ?>
		<div class="pps-project__category">
			<?php the_terms( get_the_ID(), 'project_category', '', ', ', '' ); ?>
		</div>
	<?php endif; ?>

	<h4 class="pps-project__title">
		<?php the_title(); ?>
	</h4>

	<div class="pps-project__content-wrapper">
	<?php if ( $settings['show_excerpt'] == 'yes' ): ?>
		<div class="pps-project__excerpt">
			<?php
			// Content with Trimmed
			echo wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' );
			?>
		</div>
	<?php endif; ?>

	<?php if ( $settings['show_button'] == 'yes' ): ?>
		<a href="<?php echo the_permalink(); ?>" class="pps-project__button pps-btn btn-circle">
			<?php echo esc_html( $settings['button_text'] ); ?>
			<i class="ri-arrow-right-up-line"></i>
		</a>
	<?php else : ?>
		<a href="<?php echo esc_url( $project_link ) ?>" class="pps-project__button pps-btn btn-circle" target="_blankf">
			<?php echo esc_html( $settings['button_text'] ); ?>
			<i class="ri-arrow-right-up-line"></i>
		</a>
	<?php endif; ?>
	</div>

</div>
<!-- /.pps-project -->
