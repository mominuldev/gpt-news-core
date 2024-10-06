(function ($) {
	"use strict";

	var heading = function ($scope, $) {
		var elements = {
			title: $scope.find('.anime-title'),
			subTitle: $scope.find('.anime-subtitle'),
			text: $scope.find('.anime-text')
		};

		var headingsData = {
			type: elements.title.attr('data-animate-type'),
			style: elements.title.attr('data-animate-style'),
			duration: elements.title.attr('data-animate-duration')
		};

		var textData = {
			type: elements.text.attr('data-animate-type'),
			style: elements.text.attr('data-animate-style'),
			duration: elements.text.attr('data-animate-duration'),
			delay: elements.text.attr('data-animate-delay')
		};

		let titleLines = gsap.utils.toArray(elements.title);
		let subTitleLines = gsap.utils.toArray(elements.subTitle);
		let textLines = gsap.utils.toArray(elements.text);

		function animateItems(tl, itemSplitted, delay = 0, style = 'one', duration = 1, type = 'words') {
			const animationMap = {
				one: { opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 },
				two: { opacity: 0, y: 70, ease: "power4.out", stagger: 0.03 },
				three: { opacity: 0, x: 70, autoAlpha: 0, stagger: 0.05 },
				four: {  opacity: 0, x: -100, duration: 1, stagger: 0.05, delay: 0.5  },
				five: {  opacity: 0, duration: 0.1, stagger: 0.05, ease: "none"  },
				six: {  skewX: 45, x: 50, opacity: 0, duration: 1, stagger: 0.03, ease: "power4.out",  },
				seven: {  opacity: 0, scale: 0, duration: 1, stagger: 0.05, ease: "elastic.out(1, 0.75)" },
				eight: {  scaleX: 0, opacity: 0, duration: 1, stagger: 0.05, ease: "power2.out", transformOrigin: "center" },

			};
			tl.from(itemSplitted[type], { ...animationMap[style], duration, delay });
		}

		function animateContent(splitItems, type, style, duration, delay) {
			splitItems.forEach(splitItem => {
				const tl = gsap.timeline({
					scrollTrigger: {
						trigger: splitItem,
						start: 'top 90%',
						end: 'bottom 60%',
						toggleActions: 'play none none none'
					}
				});

				const itemSplitted = new SplitText(splitItem, { type });
				gsap.set(splitItem, { perspective: 400 });
				itemSplitted.split({ type });

				animateItems(tl, itemSplitted, delay, style, duration, type);
			});
		}

		// Animate Titles, SubTitles, and Text
		animateContent(titleLines, headingsData.type, headingsData.style, headingsData.duration);
		animateContent(subTitleLines, headingsData.type, headingsData.style, headingsData.duration);
		animateContent(textLines, textData.type, textData.style, textData.duration, textData.delay);
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/mpt-heading.default', heading);
	});

})(window.jQuery);




// (function ($) {
//
// 	"use strict";
// 	var heading = function ($scope, $) {
//
// 		var element = $scope.find('.anime-title');
// 		var elementSubTitle = $scope.find('.anime-subtitle');
//
// 		// var AnimeType = element.attr('data-animate-type');
//
// 		// Heading Animation
// 		var heading = $scope.find('.section-heading');
// 		var animateType = element.attr('data-animate-type');
// 		var animateStyle = element.attr('data-animate-style');
// 		var animateDuration = element.attr('data-animate-duration');
//
// 		// Description Animation
// 		var elementText = $scope.find('.anime-text');
// 		var desAnimateType = elementText.attr('data-animate-type');
// 		var desAnimateStyle = elementText.attr('data-animate-style');
// 		var animationDuration = elementText.attr('data-animate-duration');
// 		var animationDelay = elementText.attr('data-animate-delay');
//
//
// 		let splitTitleLinesSubTitle = gsap.utils.toArray(elementSubTitle);
// 		let splitTitleLines = gsap.utils.toArray(element);
// 		let splitTitleLinesText = gsap.utils.toArray(elementText);
//
// 		// Animation Words
// 		function animationWords(tl, itemSplitted, delay = 0, animateStyle = 'one', duration = 1) {
// 			if( animateStyle == 'one' ) {
// 				tl.from(itemSplitted.words, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
// 			} else if( animateStyle == 'two' ) {
// 				tl.from(itemSplitted.words, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.03, delay: delay });
// 			} else if( animateStyle == 'three' ) {
// 				tl.from(itemSplitted.words, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay });
// 			}
// 		}
//
// 		// Animation Chars
// 		function animationChars(tl, itemSplitted, delay = 0, animateStyle = 'one', duration = 1) {
// 			if( animateStyle == 'one' ) {
// 				tl.from(itemSplitted.chars, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
// 			} else if( animateStyle == 'two' ) {
// 				tl.from(itemSplitted.chars, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.03, delay: delay });
// 			} else if( animateStyle == 'three' ) {
// 				tl.from(itemSplitted.chars, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay});
// 			}
// 		}
//
// 		// Animation Lines
// 		function animationLines(tl, itemSplitted, delay = 0, animateStyle, duration = 1) {
// 			if( animateStyle == 'one' ) {
// 				tl.from(itemSplitted.lines, {duration: duration, delay: delay, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1});
// 			} else if( animateStyle == 'two' ) {
// 				tl.from(itemSplitted.lines, { opacity: 0, y: 70, duration: duration, ease: "power4.out", stagger: 0.1, delay: delay });
// 			} else if( animateStyle == 'three' ) {
// 				tl.from(itemSplitted.lines, { duration: duration, x: 70, autoAlpha: 0, opacity: 0, stagger: 0.05, delay: delay});
// 			}
// 		}
//
// 		// Animation Heading
// 		splitTitleLines.forEach(splitTextLine => {
// 			const tl = gsap.timeline({
// 				scrollTrigger: {
// 					trigger: splitTextLine,
// 					start: 'top 90%',
// 					end: 'bottom 60%',
// 					scrub: false,
// 					markers: false,
// 					toggleActions: 'play none none none'
// 				}
// 			});
//
// 			const itemSplitted = new SplitText(splitTextLine, { type: animateType });
// 			gsap.set(splitTextLine, { perspective: 400 });
// 			itemSplitted.split({ type: animateType })
//
// 			if(animateType == 'words') {
// 				animationWords(tl, itemSplitted, 0, animateStyle, animateDuration);
// 			} else if(animateType == 'chars' ) {
// 				animationChars(tl, itemSplitted, 0, animateStyle, animateDuration);
// 			} else {
// 				animationLines(tl, itemSplitted, 0, animateStyle, animateDuration)
// 			}
// 		});
//
// 		// Animation Description
// 		splitTitleLinesText.forEach(splitTextLine => {
// 			const tl = gsap.timeline({
// 				scrollTrigger: {
// 					trigger: splitTextLine,
// 					start: 'top 90%',
// 					end: 'bottom 60%',
// 					scrub: false,
// 					markers: false,
// 					toggleActions: 'play none none none'
// 				}
// 			});
//
// 			const itemSplitted = new SplitText(splitTextLine, { type: desAnimateType });
// 			gsap.set(splitTextLine, { perspective: 400 });
// 			itemSplitted.split({ type: desAnimateType })
//
// 			if(desAnimateType == 'words') {
// 				animationWords(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration);
// 			} else if(desAnimateType == 'chars' ) {
// 				animationChars(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration);
// 			} else {
// 				animationLines(tl, itemSplitted, animationDelay, desAnimateStyle, animationDuration)
// 			}
// 		});
//
// 		splitTitleLinesSubTitle.forEach(splitTextLine => {
// 			const tl = gsap.timeline({
// 				scrollTrigger: {
// 					trigger: splitTextLine,
// 					start: 'top 90%',
// 					end: 'bottom 60%',
// 					scrub: false,
// 					markers: false,
// 					toggleActions: 'play none none none'
// 				}
// 			});
//
// 			const itemSplitted = new SplitText(splitTextLine, { type: animateType });
// 			gsap.set(splitTextLine, { perspective: 400 });
// 			itemSplitted.split({ type: animateType })
//
// 			if(animateType == 'words') {
// 				animationWords(tl, itemSplitted, 0, animateStyle);
// 			} else if(animateType == 'chars' ) {
// 				animationChars(tl, itemSplitted, 0, animateStyle);
// 			} else {
// 				animationLines(tl, itemSplitted, 0, animateStyle)
// 			}
// 		});
// 	};
// 	$(window).on('elementor/frontend/init', function () {
// 		elementorFrontend.hooks.addAction('frontend/element_ready/mpt-heading.default', heading);
// 	});
//
// })(window.jQuery);