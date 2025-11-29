AOS.init();

// Mobile menu toggle
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

mobileMenuButton.addEventListener('click', () => {
  mobileMenu.classList.toggle('hidden');
});


// Hero Slider Functionality
const slides = [
  document.getElementById('slide-1'),
  document.getElementById('slide-2'),
  document.getElementById('slide-3')
];

const dots = [
  document.getElementById('slide-dot-1'),
  document.getElementById('slide-dot-2'),
  document.getElementById('slide-dot-3')
];

let currentSlide = 0;

function showSlide(index) {
  // Hide all slides
  slides.forEach(slide => {
    slide.classList.remove('active-slide');
    slide.classList.add('inactive-slide');
  });

  // Show selected slide
  slides[index].classList.remove('inactive-slide');
  slides[index].classList.add('active-slide');

  // Update dots
  dots.forEach(dot => {
    dot.classList.remove('active');
    dot.classList.remove('bg-opacity-100');
    dot.classList.add('bg-opacity-50');
  });

  dots[index].classList.add('active');
  dots[index].classList.remove('bg-opacity-50');
  dots[index].classList.add('bg-opacity-100');

  currentSlide = index;
}

function nextSlide() {
  let newIndex = (currentSlide + 1) % slides.length;
  showSlide(newIndex);
}

function prevSlide() {
  let newIndex = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(newIndex);
}

// Set up event listeners
document.getElementById('next-slide').addEventListener('click', nextSlide);
document.getElementById('prev-slide').addEventListener('click', prevSlide);

// Dot navigation
dots.forEach((dot, index) => {
  dot.addEventListener('click', () => {
    showSlide(index);
  });
});

// Auto-advance slides every 5 seconds
setInterval(nextSlide, 5000);


// Our Project Section Slider
const sliderTrack = document.getElementById('slider-track');
let cardWidth = sliderTrack.children[0].offsetWidth;
let autoSlideInterval;

function startAutoSlide() {
  autoSlideInterval = setInterval(() => {
    // Clone first card and append at the end
    const firstCard = sliderTrack.children[0];
    const clone = firstCard.cloneNode(true);
    sliderTrack.appendChild(clone);

    // Animate slide to left by cardWidth
    sliderTrack.style.transition = 'transform 0.5s ease-in-out';
    sliderTrack.style.transform = `translateX(-${cardWidth}px)`;

    // After transition ends, remove first card and reset transform
    sliderTrack.addEventListener('transitionend', function handler() {
      sliderTrack.style.transition = 'none';
      sliderTrack.style.transform = 'translateX(0)';
      sliderTrack.removeChild(firstCard);
      sliderTrack.removeEventListener('transitionend', handler);
    });
  }, 4000); // auto slide every 4 seconds
}

function slideNext() {
  clearInterval(autoSlideInterval);
  // Same logic as autoSlide but triggered manually
  const firstCard = sliderTrack.children[0];
  const clone = firstCard.cloneNode(true);
  sliderTrack.appendChild(clone);

  sliderTrack.style.transition = 'transform 0.5s ease-in-out';
  sliderTrack.style.transform = `translateX(-${cardWidth}px)`;

  sliderTrack.addEventListener('transitionend', function handler() {
    sliderTrack.style.transition = 'none';
    sliderTrack.style.transform = 'translateX(0)';
    sliderTrack.removeChild(firstCard);
    sliderTrack.removeEventListener('transitionend', handler);
    startAutoSlide(); // restart auto slide after manual slide
  });
}

function slidePrev() {
  clearInterval(autoSlideInterval);
  // To slide prev, we take last card, prepend it and shift track left immediately, then animate back to normal position
  const cards = sliderTrack.children;
  const lastCard = cards[cards.length - 1];
  const clone = lastCard.cloneNode(true);
  sliderTrack.insertBefore(clone, cards[0]);

  sliderTrack.style.transition = 'none';
  sliderTrack.style.transform = `translateX(-${cardWidth}px)`;

  // Force reflow
  void sliderTrack.offsetWidth;

  sliderTrack.style.transition = 'transform 0.5s ease-in-out';
  sliderTrack.style.transform = 'translateX(0)';

  sliderTrack.addEventListener('transitionend', function handler() {
    sliderTrack.style.transition = 'none';
    sliderTrack.removeChild(lastCard);
    sliderTrack.removeEventListener('transitionend', handler);
    startAutoSlide(); // restart auto slide after manual slide
  });
}

window.addEventListener('resize', () => {
  cardWidth = sliderTrack.children[0].offsetWidth;
  sliderTrack.style.transition = 'none';
  sliderTrack.style.transform = 'translateX(0)';
});

// Start auto slide on page load
startAutoSlide();


// Home page testimonial slider
(function () {
  const track = document.getElementById("testimonial-track");
  const slides = document.querySelectorAll("#testimonial-track > div");
  const slideWidth = slides[0].offsetWidth;
  let interval;

  function startAutoSlide() {
    interval = setInterval(() => {
      const firstSlide = track.children[0];
      const clone = firstSlide.cloneNode(true);
      track.appendChild(clone);

      track.style.transition = "transform 0.5s ease-in-out";
      track.style.transform = `translateX(-${slideWidth}px)`;

      track.addEventListener(
        "transitionend",
        function handleTransition() {
          track.style.transition = "none";
          track.style.transform = "translateX(0)";
          track.removeChild(firstSlide);
          track.removeEventListener("transitionend", handleTransition);
        }
      );
    }, 4000); // Every 4 seconds
  }

  // Responsive Adjustment
  window.addEventListener("resize", () => {
    clearInterval(interval);
    track.style.transition = "none";
    track.style.transform = "translateX(0)";
    startAutoSlide();
  });

  startAutoSlide();
})();

