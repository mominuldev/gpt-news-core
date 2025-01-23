<div class="pps-post-item">
	<div class="pps-post-item__content-inner">
		<?php if ( has_post_thumbnail() ): ?>
			<div class="pps-post-item__feature-image">
				<a href="<?php echo the_permalink(); ?>">
					<?php the_post_thumbnail( 'genesis_blog_grid_410x290', array( 'class' => 'img-fluid' ) ) ?>
				</a>

			</div>
		<?php endif; ?>

		<div class="pps-post-item__blog-content">

			<div class="pps-post-item__meta">
				<?php if ( 'yes' == $settings['category_show'] ) : ?>
					<div class="pps-post-item__category">
						<?php
						$terms = get_the_terms( get_the_ID(), 'category' );
						if ( $terms && ! is_wp_error( $terms ) ) :
							$cat_temp = '';
							foreach ( $terms as $term ) {
								$cat_temp .= '<a href="' . get_category_link( $term->term_id ) . '"   class="category" rel="category">' . esc_html( $term->name ) . '</a>';
							}
						endif;

						echo $cat_temp;
						?>
					</div>
				<?php endif; ?>

				<?php if ( 'yes' == $settings['meta_show'] ) : ?>
					<div class="pps-post-item__date-meta">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
							<g opacity="0.6">
								<path d="M19 10.0039C19 14.9719 14.968 19.0039 10 19.0039C5.032 19.0039 1 14.9719 1 10.0039C1 5.03591 5.032 1.00391 10 1.00391C14.968 1.00391 19 5.03591 19 10.0039Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M13.3391 12.8659L10.5491 11.2009C10.0631 10.9129 9.66705 10.2199 9.66705 9.65289V5.96289" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</g>
						</svg>

						<?php pps_Theme_Helper::pps_posted_on(); ?>
					</div>
				<?php endif; ?>
				</div>

			<h3 class="pps-post-item__entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<p class="pps-post-item__entry-content">
				<?php echo pps_Theme_Helper::pps_excerpt( $settings['content_length'] ); ?>
			</p>

			<?php if(! empty($settings['read_more_text']) &&  'yes' === $settings['readmore_show']): ?>
				<div class="pps-post-item__read-more">
					<a href="<?php echo get_the_permalink(); ?>" class="pps-btn btn-outline btn-sm btn-round"><?php echo esc_html($settings['read_more_text']); ?></a>
				</div>
			<?php endif; ?>


		</div>
	</div>

</div>