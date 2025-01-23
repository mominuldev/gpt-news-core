<div class="products__item__image mobile-view">
	<div class="reveal">
		<?php if ( has_post_thumbnail() ): ?>
			<?php the_post_thumbnail( 'full' ); ?>
		<?php endif; ?>
	</div>
</div>
<!-- /.pps-project__image -->

<div class="products__item-content">
	<div class="products__item-title-wrapper">
		<h3 class="products__item-title">
			<?php the_title(); ?>
		</h3>

		<?php if ( $settings['show_category'] == 'yes' ): ?>
			<div class="pps-project__category">
				<?php the_terms( get_the_ID(), 'project_category', '', ', ', '' ); ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="products__item-arrow">
		<svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M29.5 4.5L2 32" stroke="white" stroke-width="3" stroke-linecap="round"/>
			<path d="M14.5 2.32883C14.5 2.32883 28.5838 1.14161 30.7213 3.27888C32.8585 5.41618 31.671 19.5001 31.671 19.5001" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>

	</div>
</div>
