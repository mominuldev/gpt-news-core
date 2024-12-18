<?php
if ( $layout === 'four' ) :
	if ( $count == 0 ) : ?>
		<!-- Left column (1 large post) -->
		<div class="col-md-6">

			<div class="blog-hero-item-grid blog-hero-main-grid-four">
				<div class="blog-hero-item-grid__image">
					<a href="<?php the_permalink(); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'gpt-hero_four_600x750', array( 'alt' => get_the_title() ) );
						} else { ?>
							<img src="https://via.placeholder.com/410x290" alt="Placeholder">
						<?php } ?>
					</a>

				</div>
				<div class="blog-hero-item-grid__content">
					<a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="gpt-blog__meta-category" style="background: <?php echo $color; ?>">
						<?php echo get_the_category()[0]->name; ?>
					</a>
					<h2 class="blog-hero-item-grid__title blog-title-hover">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php if ( $meta_show == 'yes' ) : ?>
						<ul class="entry-meta">
							<li>
								<?php Gpt_Theme_Helper::post_author_by(); ?>
							</li>
							<li>
								<i class="ri-calendar-2-line"></i>
								<?php Gpt_Theme_Helper::gpt_posted_on(); ?>
							</li>
						</ul><!-- .entry-meta -->
					<?php endif; ?>
				</div>
			</div>




		</div>

	<?php elseif ( $count == 1 ) : ?>
		<!-- Right column starts here -->
		<div class="col-md-6">
		<div class="row">
	<?php endif; ?>

	<?php if ( $count >= 1 && $count <= 4 ) : ?>
	<!-- Posts in the right column -->
	<div class="col-md-6 mb-5">
		<div class="blog-hero-item-grid blog-hero-grid-four">
			<div class="blog-hero-item-grid__image">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('gpt_hero_grid_two_436x300', ['class' => 'wp-post-image']); ?>
				</a>

			</div>
			<div class="blog-hero-item-grid__content">
				<a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="gpt-blog__meta-category" style="background: <?php echo $color; ?>">
					<?php echo get_the_category()[0]->name; ?>
				</a>
				<h2 class="blog-hero-item-grid__title blog-title-hover">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<?php if ( $meta_show == 'yes' ) : ?>
					<ul class="entry-meta">
						<li>
							<?php Gpt_Theme_Helper::post_author_by(); ?>
						</li>
						<li>
							<i class="ri-calendar-2-line"></i>
							<?php Gpt_Theme_Helper::gpt_posted_on(); ?>
						</li>
					</ul><!-- .entry-meta -->
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>

	<?php if ( $count == 4 ) : ?>
	</div> <!-- Close nested row -->
	</div> <!-- Close right column -->
<?php endif; ?>
<?php endif; ?>
