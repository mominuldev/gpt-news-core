(function ($, elementor) {
	"use strict";

	var PPS = {

		initWidgets: function() {
			var widgets = {
				'mpt-hero-static.default': PPS.Hero,
				'mpt-highlight-heading.default': PPS.HightlightHeading,
				'mpt-project-slider.default': PPS.Slider,
				'mpt-project-slider-creative.default': PPS.ImageCarousel,
				'mpt-blog-slider.default': PPS.BlogSlider,
				'mpt-dynamic-tabs.default': PPS.DynamicTabs,
				'mpt-project-list.default': PPS.ProjectList,
				'mpt-feature-list-tabs.default': PPS.Tabs,
				'mpt-testimonial.default': PPS.Testimonial,
				'mpt-testimonial-creative.default': PPS.TestimonialCreative,
				'mpt-logo-carousel.default': PPS.Logo,
				'mpt-coming-soon.default': PPS.Counting,
				'mpt-pin-video.default': PPS.PinVideo,
				'mpt-logo-marquee.default': PPS.LogoMaequee,
				'mpt-marque-text-advance.default': PPS.MarqueText,

			};

			// $.each(widgets, function (widget, callback) {
			// 	elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			// });

			// $.each(widgets, function (widget, callback) {
			// 	elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
			// });

			$.each(widgets, function (widget, callback) {
				elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
			});

		},

		MarqueText: function ($scope) {
			var slideInit = $scope.find('.marquee__text-inner');
			gsap.registerPlugin(ScrollTrigger);
			// Duration
			var duration = slideInit.data('duration') ? slideInit.data('duration') : 60;
			var arrowSelector = document.querySelectorAll(".arrow");

			let currentScroll = 0
			let isScrollingDown = true
			function throttle(callback, limit) {
				let wait = false
				return function () {
					if (!wait) {
						callback.apply(null, arguments)
						wait = true
						setTimeout(() => {
							wait = false
						}, limit)
					}
				}
			}

			// Add "active" class to the arrow element when direction changes
			// window.addEventListener(
			// 	"scroll",
			// 	throttle(function () {
			// 		if (window.pageYOffset > currentScroll) {
			// 			isScrollingDown = true
			// 		} else {
			// 			isScrollingDown = false
			// 		}
			//
			// 		// gsap.to(tween, {
			// 		// 	timeScale: isScrollingDown ? 1 : -1,
			// 		// })
			//
			// 		arrowSelector.forEach((arrow) => {
			// 			if (isScrollingDown) {
			// 				arrow.classList.remove("active")
			// 			} else {
			// 				arrow.classList.add("active")
			// 			}
			// 		})
			//
			// 		currentScroll = window.pageYOffset
			// 	}, 200) // Adjust the throttling delay (in milliseconds) as needed
			// )



			// Get the initial direction from a data attribute
			let direction = slideInit.data('initial-direction') === 'right' ? 1 : -1; // 1 = right (forward), -1 = left (backward)

			const roll1 = roll(slideInit, {duration: duration}),
				scroll = ScrollTrigger.create({
					trigger: document.querySelector('[data-scroll-container]'),
					onUpdate(self) {
						// Check if the direction changed
						if (self.direction !== direction) {
							// Toggle the direction
							direction *= -1;
							// Reverse the animation direction
							gsap.to([roll1], {timeScale: direction, overwrite: true});

							// Add Active Class to Arrow
							arrowSelector.forEach((arrow) => {
								if (direction === 1) {
									arrow.classList.remove("active")
								} else {
									arrow.classList.add("active")
								}
							})

						} else {
							roll1.timeScale(direction);
						}
					}
				});

			// helper function for rolling effect
			function roll(targets, vars, reverse) {
				vars = vars || {};
				vars.ease || (vars.ease = "none");
				const tl = gsap.timeline({
						repeat: -1,
						onReverseComplete() {
							this.totalTime(this.rawTime() + this.duration() * 10);
						}
					}),
					elements = gsap.utils.toArray(targets),
					clones = elements.map(el => {
						let clone = el.cloneNode(true);
						el.parentNode.appendChild(clone);
						return clone;
					}),
					positionClones = () => elements.forEach((el, i) => gsap.set(clones[i], {position: "absolute", overwrite: false, top: el.offsetTop, left: el.offsetLeft + (reverse ? -el.offsetWidth : el.offsetWidth)}));
				positionClones();
				elements.forEach((el, i) => tl.to([el, clones[i]], {xPercent: reverse ? 100 : -100, ...vars}, 0));
				window.addEventListener("resize", () => {
					let time = tl.totalTime();
					tl.totalTime(0);
					positionClones();
					tl.totalTime(time);
				});
				return tl;
			}
		},

		HightlightHeading: function ($scope) {
			// var title = $scope.find('.mpt-title');
			gsap.registerPlugin(ScrollTrigger);
			const title = document.querySelectorAll('.mpt-title');
			// const title = gsap.utils.toArray('.mpt-title');


			title.forEach(function (char, i) {
				let heading_title = new SplitText(char, {type: 'chars, words', linesClass: "lineChild"});
				let heading_char = heading_title.chars
				let heading_line = heading_title.line

				let bg = char.dataset.bgColor
				let fg = char.dataset.fgColor

				gsap.fromTo(heading_char,
					{
						color: bg,
					},
					{
						color: fg,
						duration: 0.3,
						stagger: 0.02,
						opacity: 1,
						scrollTrigger: {
							trigger: char,
							start: "top 80%",
							end: "top 20%",
							toggleActions: "play none none reverse",
							scrub: true
						},
					}
				);


			});
		},

		PinVideo: function ($scope) {
			let video = $scope.find('.video-player-area');

			// Register ScrollTrigger
			gsap.registerPlugin(ScrollTrigger);

			let timeline = gsap.timeline();

			// Set Will Change
			gsap.set('.video-area', {
				willChange: "transform",
				transform: "translate3d(0, 0, 0)",
			});

			// Scale3d Animation

			let tl = gsap.timeline({
				scrollTrigger: {
					trigger: video,
					start: "10% 10%",
					end: "50% 80%",
					toggleActions: "play none none none",
					markers: true,
					scrub: 4,
					pin: true,
					pinSpacing: false,
					duration: 5,

				},
			});

			tl.to('.video-area', {
				width: "7%",
				height: "5%",
				rotation: 5,
				scale: 0.5,
				// ease: "power2.inOut",
				// duration: 3,
				// stagger: 0.5,
				// yoyo: true


			});

			// tl.to('.top-title', {
			// 	opacity: 1,
			// 	y: -300,
			// 	duration: 5,
			// })
			//
			// tl.to('.left-title', {
			// 	opacity: 1,
			// 	x: -300,
			// 	duration: 5,
			// })
			//
			// tl.to('.right-title', {
			// 	opacity: 1,
			// 	x: 300,
			// 	duration: 5,
			// })
			//
			// tl.to('.bottom-title', {
			// 	opacity: 1,
			// 	y: 300,
			// 	duration: 1,
			// })

			// Select all videos with data attribute wb-embed="video"
			const videos = document.querySelectorAll('[wb-embed="video"]');

			// Loop through all the videos
			videos.forEach((video) => {
				// Pause on initial load
				video.pause();
				video.addEventListener("click", (event) => {
					if (video.paused) {
						video.muted = false;
						video.play();
					} else {
						video.pause();
						//video.currentTime = 0; // resets video back to start on click
					}
				});
			});


		},

		LogoMaequee: function ($scope) {
			var slideInit = $scope.find('.marquee-inner-wrap');

			/**
			 * Scrolltrigger Scroll Logos
			 */
			// Scrolling Letters Both Direction
			// https://codepen.io/GreenSock/pen/rNjvgjo
			// Fixed example with resizing
			// https://codepen.io/GreenSock/pen/QWqoKBv?editors=0010

			gsap.registerPlugin(ScrollTrigger);

			let direction = -1; // 1 = forward, -1 = backward scroll

			const roll1 = roll(slideInit, {duration: 18}),
				// roll2 = roll(".rollingText02", {duration: 10}, true),
				scroll = ScrollTrigger.create({
					trigger: document.querySelector('[data-scroll-container]'),
					onUpdate(self) {
						if (self.direction !== direction) {
							direction *= -1;
							gsap.to([roll1], {timeScale: direction, overwrite: true});
						} else {
							roll1.timeScale(direction);
						}
					}
				});


			// helper function that clones the targets, places them next to the original, then animates the xPercent in a loop to make it appear to roll across the screen in a seamless loop.
			function roll(targets, vars, reverse) {
				vars = vars || {};
				vars.ease || (vars.ease = "none");
				const tl = gsap.timeline({
						repeat: -1,
						onReverseComplete() {
							this.totalTime(this.rawTime() + this.duration() * 10); // otherwise when the playhead gets back to the beginning, it'd stop. So push the playhead forward 10 iterations (it could be any number)
						}
					}),
					elements = gsap.utils.toArray(targets),
					clones = elements.map(el => {
						let clone = el.cloneNode(true);
						el.parentNode.appendChild(clone);
						return clone;
					}),
					positionClones = () => elements.forEach((el, i) => gsap.set(clones[i], {position: "absolute", overwrite: false, top: el.offsetTop, left: el.offsetLeft + (reverse ? -el.offsetWidth : el.offsetWidth)}));
				positionClones();
				elements.forEach((el, i) => tl.to([el, clones[i]], {xPercent: reverse ? 100 : -100, ...vars}, 0));
				window.addEventListener("resize", () => {
					let time = tl.totalTime(); // record the current time
					tl.totalTime(0); // rewind and clear out the timeline
					positionClones(); // reposition
					tl.totalTime(time); // jump back to the proper time
				});
				return tl;
			}
		},


		Hero: function ($scope) {
			var element = $scope.find('.banner__title');

			var tl = gsap.timeline();

			// TextAnimation('data-subanimation', $('.banner__subtitle'), tl);
			// TextAnimation('data-animation', $('.banner__title'), tl);
			// TextAnimation('data-desanimation', $('.banner__description'), tl);

			// Designation Animation after page load

			// let text1 = new SplitText(".banner__title", { type: "lines" });
			// tl.from(text1.lines, { opacity: 0, y: 50, duration: 1, stagger: 0.2, ease: "power2.out" });

			// let text7 = new SplitText(".banner__designation", { type: "lines" });
			// tl.from(text7.lines, { opacity: 0, y: 50, duration: 1, stagger: 0.2, delay: 1 });

			// Type Animation
			// let text5 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text5.chars, { opacity: 0, duration: 0.1, stagger: 0.05, ease: "none", delay: 0.5 });

			// let text4 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text4.chars, { opacity: 0, x: 70, duration: 1, stagger: 0.05, delay: 0.5 });

			// let text2 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text2.chars, { y: 100, stagger: 0.05, duration: 1, ease: "power4.out", delay: 0.5 });

			// let text3 = new SplitText(".banner__designation", { type: "words" });
			// gsap.from(text3.words, { scale: 0, duration: 1, stagger: 0.1, ease: "back.out(1.7)", delay: 1 });

			// let text16 = new SplitText(".banner__designation", { type: "words" });
			// gsap.from(text16.words, { rotationY: 360, duration: 1, stagger: 0.1, ease: "power2.out" });

			// let text12 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text12.chars, { skewX: 45, x: 50, opacity: 0, duration: 1, stagger: 0.03, ease: "power4.out", delay: 1 });


			// let text21 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text21.chars, { opacity: 0, scale: 0, duration: 1, stagger: 0.05, ease: "elastic.out(1, 0.75)", delay: .5 });

			// Menu Hover
			// let text23 = new SplitText(".menu-item > a", { type: "chars" });
			// document.querySelector(".menu-item > a").addEventListener("mouseenter", () => {
			// 	gsap.fromTo(text23.chars, { rotationX: -90 }, { rotationX: 0, duration: 0.5, stagger: 0.05, ease: "power2.out" });
			// });

			// let text24 = new SplitText(".banner__designation", { type: "words" });
			// let text30 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text30.chars, { scaleX: 0, opacity: 0, duration: 1, stagger: 0.05, ease: "power2.out", transformOrigin: "center", delay:1 });

			// Rainbow Text Animation
			// let text28 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text28.chars, { color: "#FF0000", duration: 1, stagger: 0.05, repeat: -1, yoyo: true, ease: "none" });

			// Color Type Animation
			// let text25 = new SplitText(".banner__designation", { type: "words" });
			// gsap.from(text25.words, { opacity: 0, color: "#FF0000", duration: 1, stagger: 0.1 });

			// let text21 = new SplitText(".banner__designation", { type: "chars" });
			// gsap.from(text21.chars, { opacity: 0, scale: 0, duration: 1, stagger: 0.05, ease: "elastic.out(1, 0.75)", delay: 1 });


			// Split text into words
			let designation = new SplitText(".banner__designation", { type: "lines", linesClass: "wordChild" });
			let infos = new SplitText(".banner__info-item", { type: "words", wordsClass: "word" });
			let designation_lines = designation.lines;
			let info_words = infos.words;

			designation_lines.forEach(function (char, i) {
				gsap.from(char, {
					opacity: 0,
					y: 70,
					duration: 1,
					ease: "power2.out",
					delay: 1,
					stagger: 0.3
				})
			});

			gsap.from(info_words, {
				opacity: 0, x: 70, duration: 1, stagger: 0.05, delay: 1
			});

			let subtitle = new SplitText(".banner__subtitle", { type: "chars" });
			let title = new SplitText(".banner__title", { type: "chars" });
			let description = new SplitText(".banner__description", { type: "chars" });

			tl.from(subtitle.chars, { opacity: 0, duration: 0.1, stagger: 0.05, ease: "none", delay: 1 });

			tl.from(title.chars, { opacity: 0, duration: 0.1, stagger: 0.05, ease: "none" });
			tl.from(description.chars, { opacity: 0, duration: 0.06, stagger: 0.03, ease: "none" });

			tl.from(".split-wrap", {
				opacity: 0,
				ease: 'power2.out',
				delay: 0.5
			});


			// Banner Four Style
			// Circle Animation
			gsap.from('.banner__circle', {
				opacity: 0,
				scale: 0,
				duration: 1,
				ease: "power2.out",
				delay: 0.5

			});

			// banner__circle-stroke
			gsap.from('.banner__circle-stroke', {
				opacity: 0,
				scale: 1.1,
				duration: 1,
				ease: "power2.out",
				delay: 0.5
			});

			// banner__profile-img
			gsap.from('.banner__image-anime', {
				// opacity: 0,
				y:30,
				duration: 1,
				ease: "power2.out",
				delay: 0.5,
				scale: 1.05,
			});

			// banner__image-wrap ScrollTrigger
			gsap.registerPlugin(ScrollTrigger);

			gsap.from('.banner__image-wrap', {
				y: 100,
				scrollTrigger: {
					trigger: '.banner__image-wrap',
					start: "top 80%",
					end: "bottom 60%",
					toggleActions: "play none none reverse",
					scrub: 1
				}
			});

			// Image Animatiion
			var gradient = new Gradient();
			gradient.initGradient("#gradient-canvas");

		},

		ProjectList: function ($scope) {

			var projectList = $scope.find('.mpt-project-list');

			gsap.registerPlugin(ScrollTrigger);

			let revealContainers = document.querySelectorAll(".reveal");



			revealContainers.forEach((container) => {
				let image = container.querySelector("img");
				let tl = gsap.timeline({
					scrollTrigger: {
						// trigger: container,
						// toggleActions: "play none none none", // This ensures the animation plays only once
						// once: true // Ensure the reveal animation happens only once
						trigger: container,
						toggleActions: "restart none none reset"
					}
				});

				// 	// Reveal animation that runs once
				tl.set(container, { autoAlpha: 1 });
				tl.from(container, 1.5, {
					xPercent: -100,
					ease: Power2.out
				});
				tl.from(image, 1.5, {
					xPercent: 100,
					scale: 1.2,
					delay: -1.5,
					ease: Power2.out,
				});



				// Parallax effect for the image (continues to work on scroll)
				gsap.to(image, {
					yPercent: -10, // Adjust the percentage for stronger/weaker parallax
					ease: "none",
					scrollTrigger: {
						trigger: container,
						scrub: true, // Enables the parallax effect to be tied to the scroll position
						start: "bottom bottom", // Adjust this depending on when you want the parallax to start
						end: "bottom top", // End of the effect as the container leaves the viewport
					}
				});
			});

			// gsap.utils.toArray(".mpt-project__image img").forEach((image) => {
			// 	gsap.from(image, {
			// 		scale: 1.2, // Start zoomed in slightly?slightly
			// 		opacity: 0, // Start with no opacity
			// 		duration: 1.5,
			// 		ease: "power4.out",
			// 		scrollTrigger: {
			// 			trigger: image, // Each image triggers its own animation
			// 			start: "top 80%", // Trigger when the top of the element is 80% down the viewport
			// 			end: "bottom 60%",
			// 			toggleActions: "play none none reverse",
			// 			scrub: 1 // Smooth transition on scroll
			// 		}
			// 	});
			// });



			// Loop through each project content
			gsap.utils.toArray(".mpt-project__content").forEach((content) => {

				const tl = gsap.timeline({
					scrollTrigger: {
						trigger: content,
						start: "top 80%",
						end: "bottom 60%",
						toggleActions: "play none none reverse",
						scrub: 1
					}
				});

				// Animate category
				tl.from(content.querySelector(".mpt-project__category"), {
					y: 50,
					opacity: 0,
					duration: 0.8,
					ease: "power4.out",
					scrollTrigger: {
						trigger: content, // Each content section triggers its own animation
						start: "top 85%",
						end: "bottom 60%",
						toggleActions: "play none none reverse",
						scrub: 1
					}
				});

				// Animate title
				tl.from(content.querySelector(".mpt-project__title"), {
					y: 60,
					opacity: 0,
					duration: 0.9,
					ease: "power4.out",
					scrollTrigger: {
						trigger: content,
						start: "top 80%",
						end: "bottom 60%",
						toggleActions: "play none none reverse",
						scrub: 1
					}
				});

				// Animate excerpt
				tl.from(content.querySelector(".mpt-project__content-wrapper"), {
					y: 70,
					opacity: 0,
					duration: 1,
					ease: "power4.out",
					scrollTrigger: {
						trigger: content,
						start: "top 75%",
						end: "bottom 60%",
						toggleActions: "play none none reverse",
						scrub: 1
					}
				});

				// Animate button
				// tl.from(content.querySelector(".mpt-project__button"), {
				// 	y: 80,
				// 	opacity: 0,
				// 	duration: 1.1,
				// 	ease: "power4.out",
				// 	scrollTrigger: {
				// 		trigger: content,
				// 		start: "top 70%",
				// 		end: "bottom 60%",
				// 		toggleActions: "play none none reverse",
				// 		scrub: 1
				// 	}
				// });
			});

		},

		DynamicTabs: function ($scope) {
			var tabnav = $scope.find('#mpt-dynamic-tabs-nav li');

			$('#mpt-dynamic-tabs-nav li:nth-child(1)').addClass('active');
			$('#mpt-dynamic-tabs-content .content').hide();
			$('#mpt-dynamic-tabs-content .content:nth-child(1)').show();

			if ($('#mpt-dynamic-tabs-nav li').length > 0) {
				// $('.tt-portfolio__filter').append('<li class="indicator"></li>');
				if ($('#mpt-dynamic-tabs-nav li').hasClass('active')) {
					var cLeft = $('#mpt-dynamic-tabs-nav li.active').position().left + 'px',
						cWidth = $('#mpt-dynamic-tabs-nav li.active').css('width');
					$('.tab-swipe-line').css({
						left: cLeft,
						width: cWidth
					})
				}
			}

			// Tab Click function
			tabnav.on('click', function () {
				$('#mpt-dynamic-tabs-nav li').removeClass('active');
				$(this).addClass('active');

				var cLeft = $('#mpt-dynamic-tabs-nav li.active').position().left + 'px',
					cWidth = $('#mpt-dynamic-tabs-nav li.active').css('width');
				$('.tab-swipe-line').css({
					left: cLeft,
					width: cWidth
				});

				$('#mpt-dynamic-tabs-content .content').hide();

				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn(600);
				return false;
			});
		},


		Counting: function ($scope) {
			var counting = $scope.find('.countdown');

			counting.each(function (index, value) {
				var count_year = $(this).attr("data-count-year");
				var count_month = $(this).attr("data-count-month");
				var count_day = $(this).attr("data-count-day");
				var count_date = count_year + '/' + count_month + '/' + count_day;
				$(this).countdown(count_date, function (event) {
					$(this).html(
						event.strftime('<div class="counting"><span class="minus">-</span><span class="CountdownContent">%D<span class="CountdownLabel">Days</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%H <span class="CountdownLabel">Hours</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%M <span class="CountdownLabel">Minutes</span></span><span class="CountdownSeparator">:</span></div><div class="counting"><span class="CountdownContent">%S <span class="CountdownLabel">Seconds</span></span></div>')
					);
				});
			});
		},


		Testimonial: function ($scope) {

			var slideInit = $scope.find('[data-testi]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-testi]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-testi'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}
			});
		},

		TestimonialCreative: function ($scope) {

			var slideInit = $scope.find('.mpt-creative-testimonial');
			var layout = slideInit.data('testimonial');

			if (layout == 'three') {
				var options = {
					loop: true,
					spaceBetween: 0,
					centeredSlides: true,
					slidesPerView: 3,
					speed: 700,
					freeMode: true,
					watchSlidesProgress: true,
					breakpoints: {
						'1400': {
							slidesPerView: 3,
						},
						'1200': {
							slidesPerView: 3,
						},
						'992': {
							slidesPerView: 3,
						},
						'768': {
							slidesPerView: 3,
						},
						'576': {
							slidesPerView: 3,
						},
						'0': {
							slidesPerView: 3,
							spaceBetween: 10,
						},
					},
				}
			} else {
				var options = {
					// loop: true,
					spaceBetween: 40,
					speed: 700,
					freeMode: true,
					watchSlidesProgress: true,
					breakpoints: {
						'1400': {
							slidesPerView: 4,
						},
						'1200': {
							slidesPerView: 3,
						},
						'992': {
							slidesPerView: 3,
							spaceBetween: 30,
						},
						'768': {
							slidesPerView: 3,
						},
						'420': {
							slidesPerView: 2,
						},
						'0': {
							slidesPerView: 1,
							spaceBetween: 10,
						},
					},
				}
			}


			// Testimonial
			var swiperthumb = new Swiper(".testimonial-thumb", options);

			// Testimonial-3
			var swipertestlist = new Swiper(".mpt-creative-testimonial", {
				loop: true,
				spaceBetween: 10,
				speed: 1000,
				//  effect: 'fade',
				navigation: {
					nextEl: ".testimonial-next",
					prevEl: ".testimonial-prev",
				},
				thumbs: {
					swiper: swiperthumb,
				},
			});
		},

		Logo: function ($scope) {

			var slideInit = $scope.find('[data-logo]');

			slideInit.each(function () {
				var swps = document.querySelectorAll('[data-logo]');

				if (swps.length > 0) {
					swps.forEach(function (swp) {
						var config = JSON.parse(swp.getAttribute('data-logo'));
						var mySwiper = new Swiper(swp, config);

						$('.swiper-slide').on('mouseover', function () {
							mySwiper.autoplay.stop();
						});

						$('.swiper-slide').on('mouseout', function () {
							mySwiper.autoplay.start();
						});
					});

				}


			});
		},


	};
	// $(window).on('elementor/frontend/init', PPS.init);

	function TextAnimation($style, $selector, tl) {
		// let tl = gsap.timeline()

		var title = $selector;

		// Type Animation
		let perspective = title.attr('data-perspective')
		let style = title.attr($style);

		if (style === 'one') {
			let heading_title = new SplitText($selector, {type: 'chars, words', linesClass: "lineChild"});
			let heading_char = heading_title.chars

			tl.from(heading_char, {opacity: 0, y: 70, duration: 1.5, ease: "power4.out", stagger: 0.03});
		} else if (style === 'two') {
			let heading_title = new SplitText($selector, {type: "words, lines", linesClass: "lineChild"});
			let heading_char = heading_title.lines

			if (perspective === 'yes') {
				gsap.set($selector, {perspective: 400});
			}
			// tl.from(heading_char, {duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
			tl.from(heading_char, {
				duration: 1,
				delay: 0.3,
				opacity: 0,
				rotationX: -80,
				force3D: true,
				transformOrigin: "top center -50",
				stagger: 0.1
			});

		} else if (style === 'three') {
			let heading_title = new SplitText($selector, {type: 'chars, words', linesClass: "lineChild"});
			let heading_char = heading_title.chars
			gsap.set($selector, {perspective: 400});
			tl.from(heading_char, {
				duration: 1,
				opacity: 0,
				scale: 0,
				y: 80,
				rotationX: 100,
				transformOrigin: "0% 50% -50",
				ease: "back",
				stagger: 0.05,
			});
		} else if (style === 'four') {
			let heading_title = new SplitText($selector, {type: 'chars,words', linesClass: "lineChild"});
			let heading_char = heading_title.chars
			tl.from(heading_char, {
				duration: 1, x: 70, autoAlpha: 0, stagger: 0.05
			});
		} else if (style === 'five') {
			var mySplitText = new SplitText($selector, {type: "words,lines"}),
				lines = mySplitText.lines; //an array of all the divs that wrap each character

			tl.from(lines, {
				opacity: 0, y: 70, duration: 2, ease: "power4.out", stagger: 0.2
			});
		}
	}


	// Initialize on Elementor frontend load
	$(window).on('elementor/frontend/init', function () {
		PPS.initWidgets();  // Initialize widgets after Elementor is ready
	});

}(jQuery, window.elementorFrontend));
