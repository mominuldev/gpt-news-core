<?php
// Display first two posts in separate columns
if ( $count < 1 ) : ?>
	<div class="col-lg-7 col-md-7">
		<div class="blog-grid-item">
			<div class="blog-grid-item__image">
				<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
					} else { ?>
						<img src="https://via.placeholder.com/410x290" alt="Placeholder">
					<?php } ?>
				</a>
			</div>
			<div class="blog-grid-item__content">
				<h3 class="blog-grid-item__title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="blog-grid-item__meta">
					<span class="blog-grid-item__meta-date">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5C13.14 1.5 16.5 4.86 16.5 9Z" stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M11.7827 11.3843L9.45766 9.99684C9.05266 9.75684 8.72266 9.17934 8.72266 8.70684V5.63184" stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<span><?php echo get_the_date( 'M d, Y' ); ?></span>
					</span>
				</div>
			</div>
		</div>
	</div>

<?php
// Display the last two posts in the third column
elseif ( $count == 1 ) : ?>
	<div class="col-lg-5 col-md-5 blog-grid-item__small-wrapper">
<?php endif; ?>

<?php if ( $count >= 1 ) : ?>
	<div class="blog-grid-item__small-list-two">
		<div class="blog-grid-item__image-two">
			<a href="<?php the_permalink(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
				} else { ?>
					<img src="https://via.placeholder.com/410x290" alt="Placeholder">
				<?php } ?>
			</a>
		</div>
		<div class="blog-grid-item__content-two">
			<h3 class="blog-grid-item__title-two">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h3>
			<div class="blog-grid-item__meta">
				<span class="blog-grid-item__meta-date-two">
					<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.5 9C16.5 13.14 13.14 16.5 9 16.5C4.86 16.5 1.5 13.14 1.5 9C1.5 4.86 4.86 1.5 9 1.5C13.14 1.5 16.5 4.86 16.5 9Z" stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M11.7827 11.3843L9.45766 9.99684C9.05266 9.75684 8.72266 9.17934 8.72266 8.70684V5.63184" stroke="#141416" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<span><?php echo get_the_date( 'M d, Y' ); ?></span>
				</span>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( $count == 3 ) : ?>
	</div> <!-- Close third column after the second post -->
<?php endif; ?>