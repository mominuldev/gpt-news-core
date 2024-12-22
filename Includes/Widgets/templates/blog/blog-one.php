<?php
if ( $count < 1 ) : ?>
	<div class="col-lg-6 col-md-12">
		<div class="blog-grid">
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
				<h3 class="blog-grid__title blog-title-hover">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>

				<?php if ( $show_excerpt == 'yes' ) : ?>
					<div class="blog-grid__excerpt">
						<?php echo wp_trim_words( get_the_content(), $settings['content_length'], '...' ); ?>
					</div>
				<?php endif; ?>

				<ul class="entry-meta">
					<li>
						<?php \Gpt_Theme_Helper::post_author_by(); ?>
					</li>
					<li>
						<i class="ri-calendar-2-line"></i>
						<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
					</li>
				</ul><!-- .entry-meta -->
			</div>
		</div>
	</div>

<?php
// Display the last two posts in the third column
elseif ( $count == 1 ) : ?>
	<div class="col-lg-6 col-md-12">
	<div class="row">
<?php endif; ?>

<?php if ( $count >= 1 ) : ?>
	<div class="col-sm-6">
		<div class="blog-grid__small-list">
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
				<h3 class="blog-grid__title blog-title-hover">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="blog-grid__meta">

					<?php if ( $show_meta == 'yes' ) : ?>
						<ul class="entry-meta">
							<li>
								<i class="ri-calendar-2-line"></i>
								<?php \Gpt_Theme_Helper::gpt_posted_on(); ?>
							</li>
						</ul><!-- .entry-meta -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>

<?php if ( $count == 4 ) : ?>
	</div>
	</div> <!-- Close third column after the second post -->
<?php endif; ?>