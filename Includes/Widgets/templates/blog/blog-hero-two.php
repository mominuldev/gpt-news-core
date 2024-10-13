<?php
// Display first two posts in separate columns
if ( $count < 1 ) : ?>
	<div class="col-lg-7">
		<div class="blog-hero-item blog-hero-item--large style-two">
			<div class="blog-hero-item__image">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'gpt_hero_large_960x520', array( 'alt' => get_the_title() ) );
					} else { ?>
						<img src="https://via.placeholder.com/410x290" alt="Placeholder">
					<?php } ?>
				</a>
			</div>
			<div class="blog-hero-item__content">

				<?php
				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$cat = $categories[0];
					$cat_id = $cat->term_id;
					$cat_name = $cat->name;
					$cat_link = get_category_link( $cat_id );
					?>
					<a href="<?php echo esc_url( $cat_link ); ?>" class="gpt-blog__meta-category" style="background: <?php echo esc_attr($colors[$count]); ?>">
						<?php echo esc_html( $cat_name ); ?>
					</a>
				<?php } ?>

				<h1 class="blog-hero-item__title blog-title-hover">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h1>
				<ul class="entry-meta">
					<li>
						<?php Gpt_Theme_Helper::post_author_by(); ?>
					</li>
					<li>
						<i class="ri-calendar-2-line"></i>
						<?php Gpt_Theme_Helper::gpt_posted_on(); ?>
					</li>
				</ul><!-- .entry-meta -->
			</div>
		</div>
	</div>

<?php
// Display the last two posts in the third column
elseif ( $count == 1 ) : ?>
	<div class="col-lg-5 blog-hero-item__small-wrapper-two">
<?php endif; ?>

<?php if ( $count >= 1 ) : ?>
	<div class="blog-hero-item__small-list-two">
		<div class="blog-hero-item__image-two">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'gpt_hero_thumbnail_220x175', array( 'alt' => get_the_title() ) );
				} else { ?>
					<img src="https://via.placeholder.com/410x290" alt="Placeholder">
				<?php } ?>
			</a>
		</div>
		<div class="blog-hero-item__content-two">
			<?php
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$cat = $categories[0];
				$cat_id = $cat->term_id;
				$cat_name = $cat->name;
				$cat_link = get_category_link( $cat_id );
				?>
				<a href="<?php echo esc_url( $cat_link ); ?>" class="gpt-blog__meta-category" style="background: <?php echo esc_attr($colors[$count]); ?>">
					<?php echo esc_html( $cat_name ); ?>
				</a>
			<?php } ?>

			<h2 class="blog-hero-item__title-two blog-title-hover">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<ul class="entry-meta">
				<li>
					<?php Gpt_Theme_Helper::post_author_by(); ?>
				</li>
			</ul><!-- .entry-meta -->
		</div>
	</div>
<?php endif; ?>

<?php if ( $count == 3 ) : ?>
	</div> <!-- Close third column after the second post -->
<?php endif; ?>