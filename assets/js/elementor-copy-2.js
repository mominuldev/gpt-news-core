// (function ($, elementor) {
// 	"use strict";
//
// 	var GPT = {
//
// 		// Initialize widgets
//
// 		initWidgets: function () {
// 			var widgets = {
// 				'mpt-hero-static.default': GPT.Hero,
// 				'mpt-highlight-heading.default': GPT.HightlightHeading,
// 				'mpt-project-list.default': GPT.ProjectList,
// 				'mpt-logo-marquee.default': GPT.LogoMaequee,
// 				'mpt-marque-text-advance.default': GPT.MarqueText,
// 			};
//
// 			$.each(widgets, function (widget, callback) {
// 				elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
// 			});
//
// 		},
//
// 		Hero: function ($scope) {
// 			var element = $scope.find('.banner__title');
// 			var tl = gsap.timeline();
//
// 			// Split text into words
// 			let designation = new SplitText(".banner__designation", {type: "lines", linesClass: "wordChild"});
// 			let infos = new SplitText(".banner__info-item", {type: "words", wordsClass: "word"});
// 			let designation_lines = designation.lines;
// 			let info_words = infos.words;
//
// 			designation_lines.forEach(function (char, i) {
// 				gsap.from(char, {
// 					opacity: 0,
// 					y: 70,
// 					duration: 1,
// 					ease: "power2.out",
// 					delay: 1,
// 					stagger: 0.3
// 				})
// 			});
//
// 			gsap.from(info_words, {
// 				opacity: 0, x: 70, duration: 1, stagger: 0.05, delay: 1
// 			});
//
// 			let subtitle = new SplitText(".banner__subtitle", {type: "chars"});
// 			let title = new SplitText(".banner__title", {type: "chars"});
// 			let description = new SplitText(".banner__description", {type: "chars"});
//
// 			tl.from(subtitle.chars, {opacity: 0, duration: 0.1, stagger: 0.05, ease: "none", delay: 1});
//
// 			tl.from(title.chars, {opacity: 0, duration: 0.1, stagger: 0.05, ease: "none"});
// 			tl.from(description.chars, {opacity: 0, duration: 0.06, stagger: 0.03, ease: "none"});
//
// 			tl.from(".split-wrap", {
// 				opacity: 0,
// 				ease: 'power2.out',
// 				delay: 0.5
// 			});
//
// 			// Banner Four Style
// 			// Circle Animation
// 			gsap.from('.banner__circle', {
// 				opacity: 0,
// 				scale: .8,
// 				duration: 1,
// 				ease: "power2.out",
// 				delay: 0.5
// 			});
//
// 			// banner__circle-stroke
// 			gsap.from('.banner__circle-stroke', {
// 				opacity: 0,
// 				scale: 1.1,
// 				duration: 1,
// 				ease: "power2.out",
// 				delay: 0.5
// 			});
//
// 			// banner__profile-img
// 			gsap.from('.banner__image-anime', {
// 				// opacity: 0,
// 				y: 30,
// 				duration: 1,
// 				ease: "power2.out",
// 				delay: 0.5,
// 				scale: 1.05,
// 			});
//
// 			// Image Animation
// 			var gradient = new Gradient();
// 			gradient.initGradient("#gradient-canvas");
//
// 			gsap.registerPlugin(ScrollTrigger);
//
// 			gsap.from('.banner__image-wrap', {
// 				y: 100,
// 				scrollTrigger: {
// 					trigger: '.banner__image-wrap',
// 					start: "top 80%",
// 					end: "bottom 60%",
// 					toggleActions: "play none none reverse",
// 					scrub: 1
// 				}
// 			});
//
//
//
// 		},
//
// 		HightlightHeading: function ($scope) {
// 			// var title = $scope.find('.mpt-title');
// 			gsap.registerPlugin(ScrollTrigger);
// 			const title = document.querySelectorAll('.mpt-title');
// 			// const title = gsap.utils.toArray('.mpt-title');
//
//
// 			title.forEach(function (char, i) {
// 				let heading_title = new SplitText(char, {type: 'chars, words', linesClass: "lineChild"});
// 				let heading_char = heading_title.chars
// 				let heading_line = heading_title.line
//
// 				let bg = char.dataset.bgColor
// 				let fg = char.dataset.fgColor
//
// 				gsap.fromTo(heading_char,
// 					{
// 						color: bg,
// 					},
// 					{
// 						color: fg,
// 						duration: 0.3,
// 						stagger: 0.02,
// 						opacity: 1,
// 						scrollTrigger: {
// 							trigger: char,
// 							start: "top 80%",
// 							end: "top 20%",
// 							toggleActions: "play none none reverse",
// 							scrub: true
// 						},
// 					}
// 				);
//
//
// 			});
// 		},
//
// 		MarqueText: function ($scope) {
// 			var slideInit = $scope.find('.marquee__text-inner');
// 			// Duration
// 			var duration = slideInit.data('duration') ? slideInit.data('duration') : 60;
// 			var arrowSelector = $('.arrow');
//
// 			gsap.registerPlugin(ScrollTrigger);
//
// 			// Get the initial direction from a data attribute
// 			let direction = slideInit.data('initial-direction') === 'right' ? 1 : -1; // 1 = right (forward), -1 = left (backward)
//
// 			const roll1 = roll(slideInit, {duration: duration}),
// 				scroll = ScrollTrigger.create({
// 					trigger: document.querySelector('[data-scroll-container]'),
// 					onUpdate(self) {
// 						// Check if the direction changed
// 						if (self.direction !== direction) {
// 							// Toggle the direction
// 							direction *= -1;
// 							// Reverse the animation direction
// 							gsap.to([roll1], {timeScale: direction, overwrite: true});
//
// 							// Add "active" class to the arrow element when direction changes
// 							arrowSelector.addClass('active');
//
// 							// Optionally, remove the "active" class when scrolling Up
// 							if (direction === -1) {
// 								arrowSelector.removeClass('active');
// 							}
//
// 						} else {
// 							roll1.timeScale(direction);
// 						}
// 					}
// 				});
//
// 			// helper function for rolling effect
// 			function roll(targets, vars, reverse) {
// 				vars = vars || {};
// 				vars.ease || (vars.ease = "none");
// 				const tl = gsap.timeline({
// 						repeat: -1,
// 						onReverseComplete() {
// 							this.totalTime(this.rawTime() + this.duration() * 10);
// 						}
// 					}),
// 					elements = gsap.utils.toArray(targets),
// 					clones = elements.map(el => {
// 						let clone = el.cloneNode(true);
// 						el.parentNode.appendChild(clone);
// 						return clone;
// 					}),
// 					positionClones = () => elements.forEach((el, i) => gsap.set(clones[i], {
// 						position: "absolute",
// 						overwrite: false,
// 						top: el.offsetTop,
// 						left: el.offsetLeft + (reverse ? -el.offsetWidth : el.offsetWidth)
// 					}));
// 				positionClones();
// 				elements.forEach((el, i) => tl.to([el, clones[i]], {xPercent: reverse ? 100 : -100, ...vars}, 0));
// 				window.addEventListener("resize", () => {
// 					let time = tl.totalTime();
// 					tl.totalTime(0);
// 					positionClones();
// 					tl.totalTime(time);
// 				});
// 				return tl;
// 			}
// 		},
//
// 		LogoMaequee: function ($scope) {
// 			var slideInit = $scope.find('.marquee-inner-wrap');
//
// 			/**
// 			 * Scrolltrigger Scroll Logos
// 			 */
// 			// Scrolling Letters Both Direction
// 			// https://codepen.io/GreenSock/pen/rNjvgjo
// 			// Fixed example with resizing
// 			// https://codepen.io/GreenSock/pen/QWqoKBv?editors=0010
//
// 			gsap.registerPlugin(ScrollTrigger);
//
// 			let direction = -1; // 1 = forward, -1 = backward scroll
//
// 			const roll1 = roll(slideInit, {duration: 18}),
// 				// roll2 = roll(".rollingText02", {duration: 10}, true),
// 				scroll = ScrollTrigger.create({
// 					trigger: document.querySelector('[data-scroll-container]'),
// 					onUpdate(self) {
// 						if (self.direction !== direction) {
// 							direction *= -1;
// 							gsap.to([roll1], {timeScale: direction, overwrite: true});
// 						} else {
// 							roll1.timeScale(direction);
// 						}
// 					}
// 				});
//
//
// 			// helper function that clones the targets, places them next to the original, then animates the xPercent in a loop to make it appear to roll across the screen in a seamless loop.
// 			function roll(targets, vars, reverse) {
// 				vars = vars || {};
// 				vars.ease || (vars.ease = "none");
// 				const tl = gsap.timeline({
// 						repeat: -1,
// 						onReverseComplete() {
// 							this.totalTime(this.rawTime() + this.duration() * 10); // otherwise when the playhead gets back to the beginning, it'd stop. So push the playhead forward 10 iterations (it could be any number)
// 						}
// 					}),
// 					elements = gsap.utils.toArray(targets),
// 					clones = elements.map(el => {
// 						let clone = el.cloneNode(true);
// 						el.parentNode.appendChild(clone);
// 						return clone;
// 					}),
// 					positionClones = () => elements.forEach((el, i) => gsap.set(clones[i], {
// 						position: "absolute",
// 						overwrite: false,
// 						top: el.offsetTop,
// 						left: el.offsetLeft + (reverse ? -el.offsetWidth : el.offsetWidth)
// 					}));
// 				positionClones();
// 				elements.forEach((el, i) => tl.to([el, clones[i]], {xPercent: reverse ? 100 : -100, ...vars}, 0));
// 				window.addEventListener("resize", () => {
// 					let time = tl.totalTime(); // record the current time
// 					tl.totalTime(0); // rewind and clear out the timeline
// 					positionClones(); // reposition
// 					tl.totalTime(time); // jump back to the proper time
// 				});
// 				return tl;
// 			}
// 		},
//
// 		ProjectList: function ($scope) {
//
// 			var projectList = $scope.find('.mpt-project-list');
//
// 			gsap.registerPlugin(ScrollTrigger);
//
// 			let revealContainers = document.querySelectorAll(".reveal");
//
//
// 			revealContainers.forEach((container) => {
// 				let image = container.querySelector("img");
// 				let tl = gsap.timeline({
// 					scrollTrigger: {
// 						// trigger: container,
// 						// toggleActions: "play none none none", // This ensures the animation plays only once
// 						// once: true // Ensure the reveal animation happens only once
// 						trigger: container,
// 						toggleActions: "restart none none reset"
// 					}
// 				});
//
// 				// 	// Reveal animation that runs once
// 				tl.set(container, {autoAlpha: 1});
// 				tl.from(container, 1.5, {
// 					xPercent: -100,
// 					ease: Power2.out
// 				});
// 				tl.from(image, 1.5, {
// 					xPercent: 100,
// 					scale: 1.2,
// 					delay: -1.5,
// 					ease: Power2.out,
// 				});
//
//
// 				// Parallax effect for the image (continues to work on scroll)
// 				gsap.to(image, {
// 					yPercent: -10, // Adjust the percentage for stronger/weaker parallax
// 					ease: "none",
// 					scrollTrigger: {
// 						trigger: container,
// 						scrub: true, // Enables the parallax effect to be tied to the scroll position
// 						start: "bottom bottom", // Adjust this depending on when you want the parallax to start
// 						end: "bottom top", // End of the effect as the container leaves the viewport
// 					}
// 				});
// 			});
//
// 			// gsap.utils.toArray(".mpt-project__image img").forEach((image) => {
// 			// 	gsap.from(image, {
// 			// 		scale: 1.2, // Start zoomed in slightly?slightly
// 			// 		opacity: 0, // Start with no opacity
// 			// 		duration: 1.5,
// 			// 		ease: "power4.out",
// 			// 		scrollTrigger: {
// 			// 			trigger: image, // Each image triggers its own animation
// 			// 			start: "top 80%", // Trigger when the top of the element is 80% down the viewport
// 			// 			end: "bottom 60%",
// 			// 			toggleActions: "play none none reverse",
// 			// 			scrub: 1 // Smooth transition on scroll
// 			// 		}
// 			// 	});
// 			// });
//
//
// 			// Loop through each project content
// 			gsap.utils.toArray(".mpt-project__content").forEach((content) => {
//
// 				const tl = gsap.timeline({
// 					scrollTrigger: {
// 						trigger: content,
// 						start: "top 80%",
// 						end: "bottom 60%",
// 						toggleActions: "play none none reverse",
// 						scrub: 1
// 					}
// 				});
//
// 				// Animate category
// 				tl.from(content.querySelector(".mpt-project__category"), {
// 					y: 50,
// 					opacity: 0,
// 					duration: 0.8,
// 					ease: "power4.out",
// 					scrollTrigger: {
// 						trigger: content, // Each content section triggers its own animation
// 						start: "top 85%",
// 						end: "bottom 60%",
// 						toggleActions: "play none none reverse",
// 						scrub: 1
// 					}
// 				});
//
// 				// Animate title
// 				tl.from(content.querySelector(".mpt-project__title"), {
// 					y: 60,
// 					opacity: 0,
// 					duration: 0.9,
// 					ease: "power4.out",
// 					scrollTrigger: {
// 						trigger: content,
// 						start: "top 80%",
// 						end: "bottom 60%",
// 						toggleActions: "play none none reverse",
// 						scrub: 1
// 					}
// 				});
//
// 				// Animate excerpt
// 				tl.from(content.querySelector(".mpt-project__content-wrapper"), {
// 					y: 70,
// 					opacity: 0,
// 					duration: 1,
// 					ease: "power4.out",
// 					scrollTrigger: {
// 						trigger: content,
// 						start: "top 75%",
// 						end: "bottom 60%",
// 						toggleActions: "play none none reverse",
// 						scrub: 1
// 					}
// 				});
//
// 				// Animate button
// 				// tl.from(content.querySelector(".mpt-project__button"), {
// 				// 	y: 80,
// 				// 	opacity: 0,
// 				// 	duration: 1.1,
// 				// 	ease: "power4.out",
// 				// 	scrollTrigger: {
// 				// 		trigger: content,
// 				// 		start: "top 70%",
// 				// 		end: "bottom 60%",
// 				// 		toggleActions: "play none none reverse",
// 				// 		scrub: 1
// 				// 	}
// 				// });
// 			});
//
// 		},
//
// 	};
//
// 	// Initialize on Elementor frontend load
// 	$(window).on('elementor/frontend/init', function () {
// 		GPT.initWidgets();  // Initialize widgets after Elementor is ready
// 	});
//
// }(jQuery, window.elementorFrontend));


(function ($, elementor) {
	"use strict";

	var GPT = {
		// Initialize widgets
		initWidgets: function () {
			const widgets = {
				'mpt-hero-static.default': this.Hero.bind(this),
				'mpt-highlight-heading.default': this.HighlightHeading.bind(this),
				'mpt-project-list.default': this.ProjectList.bind(this),
				'mpt-logo-marquee.default': this.LogoMarquee.bind(this),
				'mpt-marque-text-advance.default': this.MarqueText.bind(this),
			};

			$.each(widgets, (widget, callback) => {
				elementorFrontend.hooks.addAction('frontend/element_ready/' + widget, callback);
			});
		},

		// Common animation function
		animateFrom: function (targets, vars, delay) {
			gsap.from(targets, { ...vars, delay });
		},

		// Hero widget
		Hero: function ($scope) {
			const tl = gsap.timeline();
			const animations = [
				{ selector: ".banner__designation", type: "lines", stagger: 0.3 },
				{ selector: ".banner__info-item", type: "words", stagger: 0.05, x: 70 },
				{ selector: ".banner__subtitle", type: "chars", stagger: 0.05 },
				{ selector: ".banner__title", type: "chars", stagger: 0.05 },
				{ selector: ".banner__description", type: "chars", stagger: 0.03 },
				{ selector: ".banner__circle", scale: 0.8 },
				{ selector: ".banner__circle-stroke", scale: 1.1 },
				{ selector: ".banner__image-anime", y: 30, scale: 1.05 }
			];

			animations.forEach(({ selector, type, stagger, x }) => {
				const splitText = new SplitText(selector, { type: type || "chars" });
				this.animateFrom(splitText[type ? type + 's' : 'chars'], { opacity: 0, duration: 1, stagger, ease: "power2.out", y: x ? x : 0 });
			});

			// Image Animation
			var gradient = new Gradient();
			gradient.initGradient("#gradient-canvas");

			// Image Animation with ScrollTrigger
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
		},

		// Highlight Heading widget
		HighlightHeading: function ($scope) {
			gsap.registerPlugin(ScrollTrigger);
			const titles = document.querySelectorAll('.mpt-title');

			titles.forEach((title) => {
				const headingTitle = new SplitText(title, { type: 'chars' });
				const bgColor = title.dataset.bgColor;
				const fgColor = title.dataset.fgColor;

				gsap.fromTo(headingTitle.chars, {
					color: bgColor,
				}, {
					color: fgColor,
					duration: 0.3,
					stagger: 0.02,
					opacity: 1,
					scrollTrigger: {
						trigger: title,
						start: "top 80%",
						end: "top 20%",
						toggleActions: "play none none reverse",
						scrub: true
					},
				});
			});
		},

		// Marquee Text widget
		MarqueText: function ($scope) {
			var slideInit = $scope.find('.marquee__text-inner');
			var duration = slideInit.data('duration') || 60;
			var direction = slideInit.data('initial-direction') === 'right' ? 1 : -1;

			gsap.registerPlugin(ScrollTrigger);
			const rollAnimation = this.createRollAnimation(slideInit, { duration });

			ScrollTrigger.create({
				trigger: document.querySelector('[data-scroll-container]'),
				onUpdate: (self) => {
					if (self.direction !== direction) {
						direction *= -1;
						gsap.to(rollAnimation, { timeScale: direction, overwrite: true });
					} else {
						rollAnimation.timeScale(direction);
					}
				}
			});
		},

		// Logo Marquee widget
		LogoMarquee: function ($scope) {
			var slideInit = $scope.find('.marquee-inner-wrap');
			var direction = -1;

			gsap.registerPlugin(ScrollTrigger);
			const rollAnimation = this.createRollAnimation(slideInit, { duration: 18 });

			ScrollTrigger.create({
				trigger: document.querySelector('[data-scroll-container]'),
				onUpdate: (self) => {
					if (self.direction !== direction) {
						direction *= -1;
						gsap.to(rollAnimation, { timeScale: direction, overwrite: true });
					} else {
						rollAnimation.timeScale(direction);
					}
				}
			});
		},

		// Project List widget
		ProjectList: function ($scope) {
			var projectList = $scope.find('.mpt-project-list');
			gsap.registerPlugin(ScrollTrigger);

			document.querySelectorAll(".reveal").forEach(container => {
				const image = container.querySelector("img");
				const tl = gsap.timeline({
					scrollTrigger: {
						trigger: container,
						toggleActions: "restart none none reset"
					}
				});

				tl.set(container, { autoAlpha: 1 })
					.from(container, { xPercent: -100, duration: 1.5, ease: Power2.out })
					.from(image, { xPercent: 100, scale: 1.2, delay: -1.5, duration: 1.5, ease: Power2.out });

				gsap.to(image, {
					yPercent: -10,
					ease: "none",
					scrollTrigger: {
						trigger: container,
						scrub: true,
						start: "bottom bottom",
						end: "bottom top",
					}
				});

				gsap.utils.toArray(".mpt-project__content").forEach(content => {
					const contentTimeline = gsap.timeline({
						scrollTrigger: {
							trigger: content,
							start: "top 80%",
							end: "bottom 60%",
							toggleActions: "play none none reverse",
							scrub: 1
						}
					});

					["category", "title", "content-wrapper"].forEach((item, index) => {
						contentTimeline.from(content.querySelector(`.mpt-project__${item}`), {
							y: 50 + (index * 10),
							opacity: 0,
							duration: 0.8 + (index * 0.1),
							ease: "power4.out"
						});
					});
				});
			});
		},

		// Create roll animation function
		createRollAnimation: function (targets, vars) {
			vars = vars || {};
			vars.ease = vars.ease || "none";

			const tl = gsap.timeline({ repeat: -1 });
			const elements = gsap.utils.toArray(targets);
			const clones = elements.map(el => {
				const clone = el.cloneNode(true);
				el.parentNode.appendChild(clone);
				return clone;
			});

			const positionClones = () => elements.forEach((el, i) => gsap.set(clones[i], {
				position: "absolute",
				top: el.offsetTop,
				left: el.offsetLeft + (vars.reverse ? -el.offsetWidth : el.offsetWidth)
			}));

			positionClones();
			elements.forEach((el, i) => tl.to([el, clones[i]], { xPercent: vars.reverse ? 100 : -100, ...vars }, 0));

			window.addEventListener("resize", () => {
				let time = tl.totalTime();
				tl.totalTime(0);
				positionClones();
				tl.totalTime(time);
			});
			return tl;
		}
	};

	// Initialize on Elementor frontend load
	$(window).on('elementor/frontend/init', function () {
		GPT.initWidgets();
	});

}(jQuery, window.elementorFrontend));



// Barba.js integration
// window.onload = function()  {
//
// 	barba.init({
// 		transitions: [
// 			{
// 				name: 'page-transition',
// 				once({ next }) {
// 					// Initial load animation (e.g., page loader)
// 					pageLoaderAnimation(next.container);
// 					initPageAnimations();
//
// 				},
// 				leave({ current }) {
// 					// Leaving transition for page loader
// 					return pageLeaveAnimation(current.container);
//
// 				},
// 				enter({ next }) {
// 					// Entering transition for page loader
// 					return pageEnterAnimation(next.container);
// 					ScrollTrigger.refresh();
// 					GPT.Hero($(document));
// 				}
// 			}
// 		]
// 	});
//
// 	// Barba for Elementor Widget Animations
// 	barba.hooks.afterEnter(() => {
// 		// Initialize Elementor Widget animations here
// 		if (typeof elementorFrontend !== 'undefined') {
// 			GPT.initWidgets(); // Trigger your custom Elementor animations
// 		}
// 		initPageAnimations();
// 	});
//
// 	// Page Loader Animation Functions
// 	function pageLoaderAnimation(container) {
// 		var tl = gsap.timeline();
//
// 		tl.set(".loading-screen", {
// 			top: "0",
// 		});
//
// 		// if ($(window).width() > 540) {
// 		// 	tl.set("main .once-in", {
// 		// 		y: "50vh"
// 		// 	});
// 		// } else {
// 		// 	tl.set("main .once-in", {
// 		// 		y: "10vh"
// 		// 	});
// 		// }
//
// 		tl.set(".loading-words", {
// 			opacity: 1,
// 			y: -50
// 		});
//
// 		if ($(window).width() > 540) {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "10vh",
// 			});
// 		} else {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "5vh",
// 			});
// 		}
//
// 		tl.set("html", {
// 			cursor: "wait"
// 		});
//
// 		tl.to(".loading-screen", {
// 			duration: .8,
// 			top: "-100%",
// 			ease: "Power4.easeInOut",
// 			delay: .5
// 		});
//
// 		tl.to(".loading-screen .rounded-div-wrap.bottom", {
// 			duration: 1,
// 			height: "0vh",
// 			ease: "Power4.easeInOut"
// 		},"=-.8");
//
// 		tl.to(".loading-words", {
// 			duration: .3,
// 			opacity: 0,
// 			ease: "linear",
// 		},"=-.8");
//
// 		tl.set(".loading-screen", {
// 			top: "calc(-100%)"
// 		});
//
// 		tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 			height: "0vh"
// 		});
//
// 		// tl.to("main .once-in", {
// 		// 	duration: 1,
// 		// 	y: "0vh",
// 		// 	stagger: .05,
// 		// 	ease: "Expo.easeOut",
// 		// 	clearProps: "true"
// 		// },"=-.8");
//
// 		tl.set("html", {
// 			cursor: "auto",
// 		},"=-.8");
// 	}
//
// 	function pageLeaveAnimation(container) {
// 		var tl = gsap.timeline();
//
// 		// tl.call(function() {
// 		// 	scroll.stop();
// 		// });
//
// 		ScrollTrigger.refresh();
//
// 		tl.set(".loading-screen", {
// 			top: "100%"
// 		});
//
// 		tl.set(".loading-words", {
// 			opacity: 0,
// 			y: 0
// 		});
//
// 		tl.set("html", {
// 			cursor: "wait"
// 		});
//
// 		if ($(window).width() > 540) {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "10vh",
// 			});
// 		} else {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "5vh",
// 			});
// 		}
//
// 		tl.to(".loading-screen", {
// 			duration: .5,
// 			top: "0%",
// 			ease: "Power4.easeIn"
// 		});
//
// 		if ($(window).width() > 540) {
// 			tl.to(".loading-screen .rounded-div-wrap.top", {
// 				duration: .4,
// 				height: "10vh",
// 				ease: "Power4.easeIn"
// 			},"=-.5");
// 		} else {
// 			tl.to(".loading-screen .rounded-div-wrap.top", {
// 				duration: .4,
// 				height: "10vh",
// 				ease: "Power4.easeIn"
// 			},"=-.5");
// 		}
//
// 		tl.to(".loading-words", {
// 			duration: .8,
// 			opacity: 1,
// 			y: -50,
// 			ease: "Power4.easeOut",
// 			delay: .05
// 		});
//
// 		tl.set(".loading-screen .rounded-div-wrap.top", {
// 			height: "0vh"
// 		});
//
// 		tl.to(".loading-screen", {
// 			duration: .8,
// 			top: "-100%",
// 			ease: "Power3.easeInOut"
// 		},"=-.2");
//
// 		tl.to(".loading-words", {
// 			duration: .6,
// 			opacity: 0,
// 			ease: "linear"
// 		},"=-.8");
//
// 		tl.to(".loading-screen .rounded-div-wrap.bottom", {
// 			duration: .85,
// 			height: "0",
// 			ease: "Power3.easeInOut"
// 		},"=-.6");
//
// 		tl.set("html", {
// 			cursor: "auto"
// 		},"=-0.6");
//
// 		if ($(window).width() > 540) {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "10vh"
// 			});
// 		} else {
// 			tl.set(".loading-screen .rounded-div-wrap.bottom", {
// 				height: "5vh"
// 			});
// 		}
//
// 		tl.set(".loading-screen", {
// 			top: "100%"
// 		});
//
// 		tl.set(".loading-words", {
// 			opacity: 0,
// 		});
// 	}
//
// 	function pageEnterAnimation(container) {
// 		var tl = gsap.timeline();
//
// 		ScrollTrigger.refresh();
//
// 		// if ($(window).width() > 540) {
// 		// 	tl.set("main .once-in", {
// 		// 		y: "50vh",
// 		// 	});
// 		// } else {
// 		// 	tl.set("main .once-in", {
// 		// 		y: "20vh"
// 		// 	});
// 		// }
//
// 		// tl.call(function() {
// 		// 	scroll.start();
// 		// });
//
// 		// tl.to("main .once-in", {
// 		// 	duration: 1,
// 		// 	y: "0vh",
// 		// 	stagger: .05,
// 		// 	ease: "Expo.easeOut",
// 		// 	delay: .8,
// 		// 	clearProps: "true"
// 		// });
// 	}
//
//
// 	function delay(n) {
// 		n = n || 2000;
// 		return new Promise((done) => {
// 			setTimeout(() => {
// 				done();
// 			}, n);
// 		});
// 	}
//
// 	function initNextWord(next) {
// 		// update Text Loading https://github.com/barbajs/barba/issues/507
// 		let parser = new DOMParser();
// 		let dom = parser.parseFromString(next.html, 'text/html');
// 		let nextProjects = dom.querySelector('.loading-words');
// 		document.querySelector('.loading-words').innerHTML = nextProjects.innerHTML;
// 	}
//
// 	// Function to initialize/reinitialize GSAP animations
// 	function initPageAnimations() {
// 		// Reinitialize your GSAP animations here
//
// 		// Example: Reinitialize the hero section GSAP animations
// 		GPT.Hero($(document));
//
// 		// Example: Reinitialize other animations
// 		GPT.HightlightHeading($(document));
// 		GPT.MarqueText($(document));
// 		GPT.LogoMaequee($(document));
// 		GPT.ProjectList($(document));
// 	}
//
// };
