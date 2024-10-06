(function ($) {
	// USE STRICT
	"use strict";
	// Load More

	let currentPage = 1; // Initialize the current page or offset

	$('.mpt-btn').on('click', function (e) {
		e.preventDefault(); // Prevent default action if any

		var settings = $('.mpt-projects').data('settings');

		// Increment the page number BEFORE making the request
		currentPage++;
		settings.page = currentPage; // Add the updated page or offset to the settings

		$.ajax({
			url: mpt_var.ajaxurl,
			type: 'post',
			data: {
				action: 'mpt_projects',
				nonce: mpt_var.nonce,
				settings: settings
			},
			beforeSend: () => {
				$(this).text(mpt_var.loading_text);
			},
			success: (response) => {
				if (response === '') {
					$(this).text(mpt_var.end_text);
					$(this).addClass('disabled');
				} else {
					// Append new content
					let $newContent = $(response);
					$('.mpt-projects').append($newContent);
					$(this).text(mpt_var.more_text);

					// Call the function to initialize GSAP animations for newly added content only
					initializeGSAPAnimations($newContent);
				}
			},
			error: (response) => {
				console.warn(response);
			}
		});
	});

	// Initialize GSAP animations and parallax effect, now taking in newly added content as a parameter
	function initializeGSAPAnimations($newContent) {
		gsap.registerPlugin(ScrollTrigger);

		// Select only the new content, not the previously animated elements
		let revealContainers = $newContent.find(".reveal");

		revealContainers.each(function (index, container) {
			let image = container.querySelector("img");
			let tl = gsap.timeline({
				scrollTrigger: {
					trigger: container,
					toggleActions: "play none none none", // This ensures the animation plays only once
					once: true // Ensure the reveal animation happens only once
				}
			});

			// Reveal animation that runs once
			tl.set(container, { autoAlpha: 1 });
			tl.from(container, 1.5, {
				xPercent: -100,
				ease: Power2.out
			});
			tl.from(image, 1.5, {
				xPercent: 100,
				scale: 1.3,
				delay: -1.5,
				ease: Power2.out
			});

			// Parallax effect for the image (continues to work on scroll)
			gsap.to(image, {
				yPercent: -20, // Adjust the percentage for stronger/weaker parallax
				ease: "none",
				scrollTrigger: {
					trigger: container,
					scrub: true, // Enables the parallax effect to be tied to the scroll position
					start: "top bottom", // Adjust this depending on when you want the parallax to start
					end: "bottom top", // End of the effect as the container leaves the viewport
				}
			});
		});
	}

	// Initialize GSAP animations on page load for the initial content
	// initializeGSAPAnimations($('.mpt-projects'));

})(jQuery);
