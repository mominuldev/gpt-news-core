<?php

namespace GpTheme\GptNewsCore;

class Ajax {
	public function __construct() {
		add_action( 'wp_ajax_gpt_projects', array( $this, 'gpt_projects' ) );
		add_action( 'wp_ajax_nopriv_gpt_projects', array( $this, 'gpt_projects' ) );
	}

	public function gpt_projects() {

		check_ajax_referer( 'gpt-load-more-nonce', 'nonce' );

		$settings = isset( $_POST['settings'] ) ? $_POST['settings'] : array();
		$paged = isset( $settings['page'] ) ? $settings['page'] : 1;

		$projects = new \WP_Query( array(
			'post_type'      => 'project',
			'posts_per_page' => $settings['posts_per_page'],
			'paged' => $paged, // Use the page number for pagination
		) );

		if ( $projects->have_posts() ) {
			while ( $projects->have_posts() ) {
				$projects->the_post();
				?>

				<div class="gpt-project">
					<div class="gpt-project__image">
						<div class="reveal">
							<?php if ( has_post_thumbnail() ): ?>
								<?php the_post_thumbnail( 'full' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- /.gpt-project__image -->

					<div class="gpt-project__content">

						<?php if( $settings['show_category'] == 'yes' ): ?>
							<div class="gpt-project__category">
								<?php the_terms( get_the_ID(), 'project_category', '', ', ', '' ); ?>
							</div>
						<?php endif; ?>

						<h4 class="gpt-project__title">
							<?php the_title(); ?>
						</h4>

						<?php if( $settings['show_excerpt'] == 'yes' ): ?>
							<div class="gpt-project__excerpt">
								<?php
									// Content with Trimmed
									echo wp_trim_words( get_the_content(), $settings['excerpt_length'], '...' );
								?>
							</div>
						<?php endif; ?>

						<?php if( $settings['show_button'] == 'yes' ): ?>
							<a href="<?php echo the_permalink(); ?>" class="gpt-project__button gpt-btn btn-circle">
								<?php echo esc_html( $settings['button_text'] ); ?>
								<i class="ri-arrow-right-up-line"></i>
							</a>
						<?php else : ?>
							<a href="<?php echo esc_url($project_link) ?>" class="gpt-project__button gpt-btn btn-circle" target="_blankf">
								<?php echo esc_html( $settings['button_text'] ); ?>
								<i class="ri-arrow-right-up-line"></i>
							</a>
						<?php endif; ?>

					</div>
					<!-- /.gpt-project -->
				</div>
				<?php
			}
		}

		wp_reset_postdata();
		wp_die(); // Always terminate after handling AJAX
	}
}