<div class="video-player-area">
	<div class="showreel-sticky">
		<div class="about-title-content">
			<div class="section-title smaill top-title">
				<?php echo esc_html( $settings['top_title'] ); ?>
			</div>

			<div class="about-animated-inner-block align-center-both">
				<div class="section-title smaill left-title">
					<h2><?php echo esc_html( $settings['left_title'] ); ?>
				</div>

				<div class="section-title smaill right-title">
					<?php echo esc_html( $settings['right_title'] ); ?>
				</div>
			</div>
			<!-- /.about-animated-inner-block align-center-both -->

			<div class="section-title smaill bottom-title">
				<?php echo esc_html( $settings['bottom_title'] ); ?>
			</div>
		</div>

		<div class="video-area">
			<div class="video-embed w-embed">
				<video class="video wb-video-styles-controller" autoplay="" loop="" muted="" playsinline="" poster="<?php echo esc_url( $settings['video_poster']['url'] ); ?>">
					<source src="<?php echo esc_url( $settings['video']['url'] ); ?>" type="video/mp4">
				</video>
			</div>
			<!-- /.video-embed w-embed -->

			<div class="mobile-cursor-area"><img loading="lazy" src="https://assets-global.website-files.com/643f7373d3f6653157617339/6448e195835c273a8d71af34_Video%20Player%20Icon.svg" alt="play now" class="video-play-icon"><img data-anim="roundtxt" loading="lazy" alt="play now" src="https://assets-global.website-files.com/643f7373d3f6653157617339/648050ec6410b577150dc4cf_video%20text%20circle.svg" class="video-round-text"></div>
		</div>
		<!-- /.video-area -->
	</div>
</div>
<!-- /.video-player-area -->