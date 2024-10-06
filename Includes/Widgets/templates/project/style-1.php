<div class="gpt-project__image">
	<div class="reveal">
		<?php if ( has_post_thumbnail() ): ?>
			<?php the_post_thumbnail( 'full' ); ?>
		<?php endif; ?>
	</div>
</div>
<!-- /.gpt-project__image -->

<div class="gpt-project__content">

	<?php if ( $settings['show_category'] == 'yes' ): ?>
		<div class="gpt-project__category">
			<?php the_terms( get_the_ID(), 'project_category', '', ', ', '' ); ?>
		</div>
	<?php endif; ?>

	<h4 class="gpt-project__title">
		<?php the_title(); ?>
	</h4>

	<div class="gpt-project__content-wrapper">
	<?php if ( $settings['show_excerpt'] == 'yes' ): ?>
		<div class="gpt-project__excerpt">
			<?php
			// Content with Trimmed
			echo wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' );
			?>
		</div>
	<?php endif; ?>

	<?php if ( $settings['show_button'] == 'yes' ): ?>
		<a href="<?php echo the_permalink(); ?>" class="gpt-project__button gpt-btn btn-circle">
			<?php echo esc_html( $settings['button_text'] ); ?>
			<i class="ri-arrow-right-up-line"></i>
		</a>
	<?php else : ?>
		<a href="<?php echo esc_url( $project_link ) ?>" class="gpt-project__button gpt-btn btn-circle" target="_blankf">
			<?php echo esc_html( $settings['button_text'] ); ?>
			<i class="ri-arrow-right-up-line"></i>
		</a>
	<?php endif; ?>
	</div>

</div>
<!-- /.gpt-project -->
