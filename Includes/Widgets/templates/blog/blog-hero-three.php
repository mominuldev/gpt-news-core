
<?php if ($count == 1): ?>
<div class="col-lg-8">
	<div class="blog-hero-item blog-hero-item--large style-three">
		<div class="blog-hero-item__image">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('large', ['class' => 'wp-post-image']); ?>
			</a>
		</div>
		<div class="blog-hero-item__content">
			<a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="pps-blog__meta-category" style="background: <?php echo $color; ?>">
				<?php echo get_the_category()[0]->name; ?>
			</a>
			<h1 class="blog-hero-item__title blog-title-hover">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h1>
			<?php if ( $meta_show == 'yes' ): ?>
				<ul class="entry-meta">
					<li>
						<?php PPS_Theme_Helper::post_author_by(); ?>
					</li>
					<li>
						<i class="ri-calendar-2-line"></i>
						<?php PPS_Theme_Helper::pps_posted_on(); ?>
					</li>
				</ul><!-- .entry-meta -->
			<?php endif; ?>
		</div>
	</div>

	<div class="row">
		<?php elseif ($count <= 3): // Display the next three posts in the same column ?>
		<div class="col-md-6 mt-5">
			<div class="blog-hero-item-grid">
				<div class="blog-hero-item-grid__image">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('pps_hero_grid_two_436x300', ['class' => 'wp-post-image']); ?>
					</a>

					<a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="pps-blog__meta-category" style="background: <?php echo $color; ?>">
						<?php echo get_the_category()[0]->name; ?>
					</a>
				</div>
				<div class="blog-hero-item-grid__content">

					<h2 class="blog-hero-item-grid__title blog-title-hover">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<?php if ( $meta_show == 'yes' ) : ?>
						<ul class="entry-meta">
							<li>
								<?php PPS_Theme_Helper::post_author_by(); ?>
							</li>
							<li>
								<i class="ri-calendar-2-line"></i>
								<?php PPS_Theme_Helper::pps_posted_on(); ?>
							</li>
						</ul><!-- .entry-meta -->
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ($count == 3): // Close the first column after 3 posts ?>
	</div>
</div>
<?php endif; ?>

<?php if ($count == 4): // Start the second column ?>
<div class="col-lg-4">
	<div class="row">
		<?php endif; ?>

		<?php if ($count >= 4): // Display the next 6 posts in the second column ?>
		<div class="col-md-12">
			<div class="blog-hero-item__small-list-three">
				<div class="blog-hero-item__image-three">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('pps_hero_thumbnail_220x175', ['class' => 'wp-post-image']); ?>
					</a>
				</div>
				<div class="blog-hero-item__content-three">
					<a href="<?php echo get_category_link(get_the_category()[0]->term_id); ?>" class="pps-blog__meta-category" style="background: <?php echo $color; ?>">
						<?php echo get_the_category()[0]->name; ?>
					</a>
					<h2 class="blog-hero-item__title-three blog-title-hover">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<ul class="entry-meta">
						<li>
							<i class="ri-calendar-2-line"></i>
							<?php PPS_Theme_Helper::pps_posted_on(); ?>
						</li>
					</ul><!-- .entry-meta -->
				</div>
			</div>
		</div>
		<?php endif; ?>


