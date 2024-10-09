<?php
// Display first two posts in separate columns
if ( $count < 2 ) : ?>
	<div class="col-lg-4 col-md-6">
		<div class="blog-hero-item">
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
				<h3 class="blog-hero-item__title blog-title-hover">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<span class="gpt-blog__meta-date">
					<i class="ri-time-line"></i>
					<span><?php echo get_the_date( 'M d, Y' ); ?></span>
				</span>
			</div>
		</div>
	</div>

<?php
// Display the last two posts in the third column
elseif ( $count == 2 ) : ?>
	<div class="col-lg-4 col-md-12 blog-hero-item__small-wrapper">
<?php endif; ?>

<?php if ( $count >= 2 ) : ?>
	<div class="blog-hero-item__small-list">
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
			<span class="gpt-blog__meta-date">
				<i class="ri-time-line"></i>
				<span><?php echo get_the_date( 'M d, Y' ); ?></span>
			</span>
		</div>
	</div>
<?php endif; ?>

<?php if ( $count == 3 ) : ?>
	</div> <!-- Close third column after the second post -->
<?php endif; ?>