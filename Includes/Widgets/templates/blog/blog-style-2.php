<div class="blog-grid blog-grid--three">
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

		<?php
		// Category

			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$cat = $categories[0];
				$color = get_term_meta( $cat->term_id, 'gpt_category_color', true );
				?>
				<a href="<?php echo get_category_link( $cat->term_id ); ?>" class="gpt-blog__meta-category-two" style="background: <?php echo $color; ?>">
					<?php echo $cat->name; ?>
				</a>
				<?php
			}

		?>

		<h3 class="blog-grid__title blog-title-hover">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>

		<?php if ( $settings['excerpt_show'] ) : ?>
			<div class="blog-grid__excerpt">
				<?php echo wp_trim_words( get_the_content(), $settings['content_length'], '...' ); ?>
			</div>
		<?php endif; ?>


		<?php if( $meta_show == 'yes' ) { ?>
			<ul class="entry-meta meta-style-two">
				<li>
					<?php Gpt_Theme_Helper::gpt_posted_author_avatar(); ?>
				</li>
				<li>
					<?php Gpt_Theme_Helper::gpt_posted_on(); ?>
				</li>
			</ul><!-- .entry-meta -->
		<?php } ?>
	</div>
</div>