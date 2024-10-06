///////////////////////////////////////////////////// 
// 01. Title Animation
let title_animation = gsap.utils.toArray(".title-anim");

title_animation.forEach(splitTextLine => {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: splitTextLine,
      start: 'top 90%',
      end: 'bottom 60%',
      scrub: false,
      markers: false,
      toggleActions: 'play none none none'
    }
  });

  const itemSplitted = new SplitText(splitTextLine, { type: "words, lines" });
  gsap.set(splitTextLine, { perspective: 400 });
  itemSplitted.split({ type: "lines" })
  tl.from(itemSplitted.lines, { duration: 1, delay: 0.3, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// 03. Text Animation Top
let text_anim_top = gsap.utils.toArray(".text-anim-top");

text_anim_top.forEach(splitTextLine2 => {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: splitTextLine2,
      start: 'top 100%',
      toggleActions: 'play none play reset'
    }
  });

  const itemSplitted = new SplitText(splitTextLine2, { type: 'words' }),
    textNumWords = itemSplitted.words.length;

  gsap.delayedCall(0.05, function () {
    for (var i = 0; i < textNumWords; i++) {
      tl.from(itemSplitted.words[i], 1, { force3D: true, scale: Math.random() > 0.5 ? 0 : 2, opacity: 0 }, Math.random());
    }
  });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// 02. Text Animation
let text_animation = gsap.utils.toArray(".text-anim p");

text_animation.forEach(splitTextLine => {
  const tl = gsap.timeline({
    scrollTrigger: {
      trigger: splitTextLine,
      start: 'top 90%',
      duration: 2,
      end: 'bottom 60%',
      scrub: false,
      markers: false,
      toggleActions: 'play none none none'
    }
  });

  const itemSplitted = new SplitText(splitTextLine, { type: "lines" });
  gsap.set(splitTextLine, { perspective: 400 });
  itemSplitted.split({ type: "lines" })
  tl.from(itemSplitted.lines, { duration: 1, delay: 0.5, opacity: 0, rotationX: -80, force3D: true, transformOrigin: "top center -50", stagger: 0.1 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Charchater Come Animation 
let char_come = document.querySelectorAll(".animation_char_come");

char_come.forEach((char_come) => {
  let split_char = new SplitText(char_come, { type: "chars, words" });
  gsap.from(split_char.chars, { duration: 1, x: 70, autoAlpha: 0, stagger: 0.05 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Charchater Come long Animation 
let char_come_long = document.querySelectorAll(".animation_char_come_long");

char_come_long.forEach((char_come) => {
  let split_char = new SplitText(char_come, { type: "chars, words" });
  gsap.from(split_char.chars, { duration: 1, x: 70, autoAlpha: 0, stagger: 0.15 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Charchater Up Animation 
let char_up = document.querySelector(".animation_char_up");
let split_char_up = new SplitText(char_up, { type: "chars, words" });
gsap.from(split_char_up.chars, { duration: 1, y: 15, autoAlpha: 0, stagger: 0.05 });
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Word Up Animation 
let word_up = document.querySelector(".animation_word_up");
let split_word_up = new SplitText(word_up, { type: "words", position: "absolute" });
gsap.from(split_word_up.words, { duration: 1, y: 50, autoAlpha: 0, stagger: 0.05 });
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Word Come Animation   
let word_come = document.querySelectorAll(".animation_word_come");
word_come.forEach((word_come) => {
  let split_word_come = new SplitText(word_come, { type: "chars words", position: "absolute" })
  gsap.from(split_word_come.words, { duration: 1, x: 50, autoAlpha: 0, stagger: 0.05 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
// Word Come long Animation   
let word_come_long = document.querySelectorAll(".animation_word_come_long");
word_come_long.forEach((word_come_long) => {
  let split_word_come_long = new SplitText(word_come_long, { type: "chars words", position: "absolute" })
  gsap.from(split_word_come_long.words, { duration: 1, x: 50, autoAlpha: 0, stagger: 0.5 });
});
/////////////////////////////////////////////////////


/////////////////////////////////////////////////////
const anim_reveal = document.querySelectorAll(".text_anim_reveal");

anim_reveal.forEach(areveal => {

  areveal.split = new SplitText(areveal, {
    type: "lines,words,chars",
    linesClass: "anim-reveal-line"
  });

  areveal.anim = gsap.from(areveal.split.chars, {
    scrollTrigger: {
      trigger: areveal,
      start: "top 50%",
    },
    duration: 0.6,
    ease: "circ.out",
    y: 80,
    stagger: 0.02,
    opacity: 0,
  });
});
/////////////////////////////////////////////////////
