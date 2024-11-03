<?php
// Display first two posts in separate columns
if ( $count < 2 ) : ?>
	<div class="col-lg-4 col-md-6">
		<div class="blog-hero-item style-one">
			<div class="blog-hero-item__image">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'gpt_hero_grid_800x550', array( 'alt' => get_the_title() ) );
					} else { ?>
						<img src="https://via.placeholder.com/410x290" alt="Placeholder">
					<?php } ?>
				</a>
			</div>
			<div class="blog-hero-item__content">
				<h2 class="blog-hero-item__title blog-title-hover">
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

<?php
// Display the last two posts in the third column
elseif ( $count == 2 ) : ?>
	<div class="col-lg-4 col-md-12 blog-hero-item__small-wrapper">
<?php endif; ?>

<?php if ( $count >= 2 ) : ?>
	<div class="blog-hero-item__small-list list-style-one">
		<div class="blog-hero-item__image">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'gpt_hero_thumbnail_420x270', array( 'alt' => get_the_title() ) );
				} else { ?>
					<img src="https://via.placeholder.com/410x290" alt="Placeholder">
				<?php } ?>
			</a>
		</div>
		<div class="blog-hero-item__content">
			<h3 class="blog-hero-item__title blog-title-hover">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<?php if ($meta_show == 'yes') : ?>
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
<?php endif; ?>

<?php if ( $count == 3 ) : ?>
	</div> <!-- Close third column after the second post -->
<?php endif; ?>