<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<style>
  .fade-in-section {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    will-change: opacity, transform;
  }

  .fade-in-section.is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Pagination container positioning */
  .courseSwiper .swiper-pagination {
    position: relative !important;
    margin-top: 35px;
  }

  /* Inactive dots */
  .courseSwiper .swiper-pagination-bullet {
    background: #d1d5db !important;
    /* Light Gray */
    opacity: 1 !important;
  }

  /* Active dot */
  .courseSwiper .swiper-pagination-bullet-active {
    background: #E62834 !important;
    /* Secondary color */
    opacity: 1 !important;
  }
</style>

<!-- Slider Section -->
<section class="relative w-full bg-transparent overflow-hidden fade-in-section">

  <div class="swiper mySlider w-full h-[550px] relative z-10">
    <div class="swiper-wrapper">

      <?php foreach ($hero_slides as $slide): ?>
        <div class="swiper-slide relative">

          <!-- Background Image from DB (SLIDES) -->
          <div class="absolute inset-0 bg-cover bg-center"
            style="background-image:url('<?= base_url("assets/img/home/" . $slide->bg_shape_image) ?>')">
          </div>

          <!-- Gradient Overlay -->
          <div class="absolute inset-0 bg-gradient-to-r from-background-light/80 to-transparent dark:from-background-dark/80"></div>

          <!-- CONTENT -->
          <div class="relative z-10 h-full flex items-center">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 px-4 sm:px-6 gap-6 sm:gap-10">

              <div class="text-heading-light dark:text-heading-dark space-y-6">

                <!-- Tagline -->
                <div class="inline-flex items-center bg-primary/10 px-4 py-2 rounded-full" data-animate="slide-up">
                  <div class="w-2 h-2 mr-2 rounded-full bg-secondary"></div>
                  <span class="text-secondary font-semibold text-sm tracking-wider">
                    <?= $slide->tagline ?>
                  </span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold" data-animate="slide-up" data-delay="100">
                  <span class="text-primary"><?= $slide->title ?></span>
                </h1>

                <!-- Description -->
                <p class="text-xl text-textbody-light max-w-xl" data-animate="slide-up" data-delay="200">
                  <?= $slide->description ?>
                </p>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4" data-animate="slide-up" data-delay="300">
                  <a href="<?= $slide->btn1 ?>"
                    class="inline-block px-8 py-4 rounded-lg font-semibold text-white bg-gradient-to-r from-secondary to-secondary-dark shadow-lg transition">
                    <?= $slide->btn_text_1 ?>
                  </a>

                  <a href="<?= $slide->btn2 ?>"
                    class="inline-block px-8 py-4 rounded-lg font-semibold text-white bg-gradient-to-r from-primary to-primary-dark shadow-lg transition">
                    <?= $slide->btn_text_2 ?>
                  </a>
                </div>

              </div>

            </div>
          </div>

        </div>
      <?php endforeach; ?>

    </div>

    <!-- Pagination -->
    <div class="swiper-pagination absolute bottom-6 left-1/2 -translate-x-1/2 z-30"></div>

    <!-- Navigation Buttons -->
    <button class="swiper-button-prev-custom absolute left-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center z-30">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <button class="swiper-button-next-custom absolute right-6 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white shadow-xl flex items-center justify-center z-30">
      <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
      </svg>
    </button>

  </div>
</section>

<!-- Animation & Pagination styles -->
<style>
  /* Base animations */
  @keyframes slideUpFade {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-slide-up {
    opacity: 0;
    animation: slideUpFade 0.8s cubic-bezier(.19, 1, .22, 1) forwards;
  }

  /* Background image full responsiveness */
  .swiper-slide>div[style*="background-image"] {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
  }

  /* ===================== */
  /*     RESPONSIVE FIXES   */
  /* ===================== */

  @media (max-width: 1024px) {
    .mySlider {
      height: 480px !important;
    }

    h1 {
      font-size: 2.3rem !important;
      line-height: 1.2;
    }

    p {
      font-size: 1rem !important;
    }
  }

  @media (max-width: 768px) {
    .mySlider {
      height: 420px !important;
    }

    h1 {
      font-size: 1.9rem !important;
    }

    .swiper-button-prev-custom,
    .swiper-button-next-custom {
      display: none !important;
      /* hide arrows on small devices */
    }

    .swiper-pagination {
      bottom: 14px !important;
    }
  }

  @media (max-width: 640px) {
    .mySlider {
      height: 470px !important;
    }

    h1 {
      font-size: 1.7rem !important;
      font-weight: 700;
    }

    p {
      font-size: 0.9rem !important;
      line-height: 1.4;
    }

    .max-w-6xl {
      max-width: 95% !important;
    }

    .animate-slide-up {
      animation-duration: 0.6s !important;
    }

    /* Buttons stack nicely */
    .flex.sm\:flex-row {
      flex-direction: column !important;
    }
  }

  /* Swiper pagination bullets */
  .swiper-pagination-bullet {
    width: 10px;
    height: 10px;
    background-color: rgba(255, 255, 255, 0.55);
    transition: all .25s ease;
  }

  .swiper-pagination-bullet-active {
    background: #E94D65;
    transform: scale(1.2);
  }
</style>

<!-- Swiper init script (selectors must match the buttons & pagination above) -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.mySlider', {
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      autoplay: {
        delay: 4500,
        disableOnInteraction: false
      },
      speed: 1000,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next-custom',
        prevEl: '.swiper-button-prev-custom'
      },
      on: {
        init: function() {
          // play entry animations for active slide
          const active = this.slides[this.activeIndex];
          const els = active.querySelectorAll('.animate-slide-up');
          els.forEach((el, i) => {
            el.style.animation = `slideUpFade 0.8s cubic-bezier(.19,1,.22,1) forwards ${i*0.15}s`;
          });
        },
        slideChangeTransitionStart: function() {
          // remove animations from all
          this.slides.forEach(s => {
            s.querySelectorAll('.animate-slide-up').forEach(el => {
              el.style.animation = 'none';
              el.style.opacity = '0';
            });
          });
        },
        slideChangeTransitionEnd: function() {
          const active = this.slides[this.activeIndex];
          const els = active.querySelectorAll('.animate-slide-up');
          els.forEach((el, i) => {
            // slight timeout so animation restarts cleanly
            setTimeout(() => {
              el.style.animation = `slideUpFade 0.8s cubic-bezier(.19,1,.22,1) forwards ${i*0.15}s`;
            }, 50);
          });
        }
      }
    });

    // ensure buttons are visible/focusable (just in case)
    document.querySelectorAll('.swiper-button-prev-custom, .swiper-button-next-custom, .swiper-pagination').forEach(el => {
      el.setAttribute('tabindex', '0');
    });
  });
</script>

<!-- About -->
<?php if (!empty($about)): ?>
  <section class="relative bg-white py-10 lg:py-10 overflow-hidden fade-in-section">
    <div class="container mx-auto px-6 lg:px-12 grid lg:grid-cols-2 gap-12 items-center">

      <!-- Left Images & Indicator Section -->
      <div class="relative flex items-center min-h-[450px] sm:min-h-[500px]">

        <div class="absolute -top-6 -left-4 sm:-left-8 w-20 h-20 sm:w-32 sm:h-32 bg-[#E8EEF7] rounded-full blur-2xl opacity-70"></div>

        <!-- FIRST IMAGE (STATIC SHAPE IMAGE - DO NOT CHANGE) -->
        <img src="<?= base_url('assets/img/shape-2.png') ?>"
          alt="Shape Background"
          class="absolute top-10 left-0 w-32 sm:w-64 md:w-72 h-32 sm:h-52 object-cover z-10">

        <!-- SECOND IMAGE (FROM DB → image1) -->
        <img src="<?= base_url('assets/img/about/' . $about->image1) ?>"
          alt="About Image 1"
          class="absolute top-24 sm:top-[6rem] left-2 sm:left-5 w-36 sm:w-64 md:w-64 h-48 sm:h-[26rem] rounded-lg shadow-lg object-cover z-10">

        <!-- THIRD IMAGE (FROM DB → image2) -->
        <div class="absolute top-[-50px] sm:top-[-141px] left-20 sm:left-40 
                  w-44 sm:w-[22rem] h-36 sm:h-64 rounded-lg shadow-lg border-4 
                  border-white z-20 overflow-hidden relative">

          <img src="<?= base_url('assets/img/about/' . $about->image2) ?>"
            alt="About Image 2"
            class="w-full h-full object-cover rounded-lg">

          <div class="absolute inset-0 shine-effect-once"></div>
        </div>

        <!-- Progress Card -->
        <div class="absolute bottom-4 sm:bottom-[3.5rem] left-1/2 sm:left-[15rem] transform -translate-x-1/2 z-40 animate-float">
          <div class="bg-white rounded-2xl shadow-2xl p-6 sm:p-8 w-48 sm:w-64 h-60 sm:h-80 flex flex-col items-center justify-center border border-gray-100 relative overflow-hidden">

            <!-- Circular progress -->
            <div class="relative w-24 sm:w-32 h-24 sm:h-32 flex items-center justify-center mb-4">
              <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="40" stroke="#ECEEF3" stroke-width="8" fill="none" />
                <circle cx="50" cy="50" r="40" stroke="#20406C" stroke-width="8" fill="none"
                  stroke-dasharray="251.2"
                  stroke-dashoffset="<?= 251.2 - (251.2 * ($about->progress_percent / 100)) ?>" />
              </svg>
              <div class="absolute bg-white text-primary font-bold text-xl sm:text-2xl rounded-full flex items-center justify-center w-20 sm:w-24 h-20 sm:h-24 shadow-inner border border-gray-100">
                <?= $about->progress_percent ?>%
              </div>
            </div>

            <h3 class="text-gray-800 font-semibold text-md sm:text-lg mt-2"><?= $about->tag_text ?></h3>
            <p class="text-gray-500 text-xs sm:text-sm text-center mt-2">Training Progress</p>
          </div>
        </div>
      </div>

      <!-- Right Content Section -->
      <div class="space-y-6 text-center sm:text-left">
        <span class="inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold tracking-wider border border-secondary/20 text-xs sm:text-sm">
          <?= $about->tag_text ?>
        </span>

        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-primary leading-snug">
          <?= esc($about->heading) ?>
          <div class="w-full flex items-center mt-2 gap-3">

            <!-- Left Gradient Line -->
            <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

            <!-- Left Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Center Circle -->
            <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
              <span class="h-1 w-1 bg-primary rounded-full"></span>
            </span>

            <!-- Right Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Right Gradient Line -->
            <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

          </div>
        </h2>

        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
          <?= ($about->description) ?>
        </p>

        <div class="grid sm:grid-cols-2 gap-4 sm:gap-6 pt-4">

          <!-- Feature 1 -->
          <?php if (!empty($about->feature1_icon)): ?>
            <?php for ($i = 0; $i < count($about->feature1_icon); $i++): ?>
              <div class="flex items-start gap-3 sm:gap-4">
                <div class="bg-[#E8EEF7] p-2 sm:p-3 rounded-lg">
                  <i class="<?= esc($about->feature1_icon[$i]) ?> text-primary text-xl sm:text-2xl"></i>
                </div>

                <div>
                  <h5 class="font-semibold text-gray-900 text-sm sm:text-lg">
                    <?= esc($about->feature1_title[$i]) ?>
                  </h5>

                  <p class="text-gray-600 text-xs sm:text-sm leading-relaxed">
                    <?= esc($about->feature1_description[$i]) ?>
                  </p>
                </div>
              </div>
            <?php endfor; ?>
          <?php endif; ?>

        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8 pt-6">
          <a href="<?= esc($about->learn_more_link) ?>"
            class="bg-gradient-to-r from-[#335B95] to-[#142947] text-white px-6 sm:px-8 py-3 sm:py-4 
                 rounded-full font-medium hover:opacity-90 transition-all duration-300 
                 shadow-md text-center text-sm sm:text-base btn-pulse"
            data-animate="fade-up" data-delay="500">
            Learn More
          </a>
          <div class="flex items-center gap-3 sm:gap-4">
            <img src="<?= base_url('assets/img/about/' . $about->instructor_image) ?>"
              alt="Instructor"
              class="w-12 sm:w-16 h-12 sm:h-16 rounded-full object-cover shadow">
            <div>
              <p class="text-xs sm:text-sm text-primary"><?= esc($about->instructor_title) ?></p>
              <h4 class="font-semibold text-gray-900 text-sm sm:text-base"><?= esc($about->instructor_name) ?></h4>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Animations (remain unchanged) -->
    <style>
      @keyframes float {

        0%,
        100% {
          transform: translateY(0);
        }

        50% {
          transform: translateY(-10px);
        }
      }

      .animate-float {
        animation: float 6s ease-in-out infinite;
      }

      @keyframes spin-slow {
        from {
          transform: rotate(0deg);
        }

        to {
          transform: rotate(360deg);
        }
      }

      .animate-spin-slow {
        animation: spin-slow 10s linear infinite;
      }

      @keyframes shine-once {
        0% {
          transform: translateX(-100%) rotate(25deg);
          opacity: 0;
        }

        40% {
          opacity: 0.4;
        }

        100% {
          transform: translateX(200%) rotate(25deg);
          opacity: 0;
        }
      }

      .shine-effect-once::before {
        content: '';
        position: absolute;
        top: 0;
        left: -75%;
        width: 50%;
        height: 100%;
        background: linear-gradient(120deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.8) 50%, rgba(255, 255, 255, 0) 100%);
        transform: skewX(-25deg);
        animation: shine-once 3s ease-in-out 0.5s 1;
        z-index: 10;
      }
    </style>
  </section>
<?php endif; ?>

<!-- courses section -->
<section class="py-16 bg-graylight relative overflow-hidden fade-in-section">
  <div class="container mx-auto px-6 lg:px-12 fade-up delay-1">
    <!-- Section Header -->
    <div class="text-center mb-16 fade-up delay-2">
      <?php if (!empty($course_subheading)): ?>
        <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4 fade-up delay-1"
          data-animate="fade-up" data-delay="100">
          <?= esc($course_subheading) ?>
        </span>
      <?php endif; ?>
      <?php if (!empty($course_heading)): ?>
        <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-4 fade-up delay-2"
          data-animate="fade-up" data-delay="200">
          <?= ($course_heading) ?>
          <div class="w-full flex items-center justify-center mt-2 gap-3">

            <!-- Left Gradient Line -->
            <div class="w-20 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

            <!-- Left Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Center Circle -->
            <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
              <span class="h-1 w-1 bg-primary rounded-full"></span>
            </span>

            <!-- Right Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Right Gradient Line -->
            <div class="w-20 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

          </div>
        </h2>
      <?php endif; ?>
    </div>

    <!-- ⭐ SWIPER START ⭐ -->
    <div class="swiper courseSwiper mt-10">
      <div class="swiper-wrapper">

        <?php if (!empty($courses)): ?>
          <?php
          $courseDurations = ['3 Months', '6 Months', '12 Months', '18 Months', '4 Weeks', '8 Weeks'];
          $courseLevels = ['Beginner', 'Intermediate', 'Advanced', 'Professional'];
          ?>

          <?php foreach ($courses as $index => $course): ?>
            <div class="swiper-slide">

              <!-- Course Card -->
              <div class="group relative bg-white rounded-3xl mt-16 pt-32 pb-8 px-6 shadow-lg hover:shadow-2xl 
                          transition-all duration-500 border border-gray-100 hover:border-primary/20 
                          overflow-visible fade-up delay-<?= $index ?> hover:scale-[1.02]"
                data-animate="fade-up" data-delay="<?= 300 + ($index * 100) ?>">

                <!-- Course Image -->
                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-[95%] rounded-2xl overflow-hidden shadow-xl">
                  <img src="<?= base_url('assets/img/courses/' . $course->image) ?>"
                    alt="<?= esc($course->title) ?>"
                    class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                  <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                </div>

                <!-- Icon -->
                <div class="absolute top-20 right-6 bg-white text-primary rounded-2xl p-3 shadow-xl border border-gray-100 
                            transition-all duration-500 group-hover:bg-secondary group-hover:text-white 
                            group-hover:scale-110 z-10 fade-up delay-<?= $index ?>">
                  <i class="<?= esc($course->icon) ?> text-xl"></i>
                </div>

                <!-- Content -->
                <div class="mt-8 space-y-4 fade-up delay-<?= $index + 1 ?>">
                  <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest">
                      Aviation Course
                    </span>
                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                      <?= $courseLevels[$index % count($courseLevels)] ?>
                    </span>
                  </div>

                  <h3 class="text-lg font-bold text-primary group-hover:text-primary-dark transition-colors duration-300 leading-tight min-h-[56px]">
                    <?= esc($course->title) ?>
                  </h3>

                  <div class="flex items-center justify-between text-sm text-gray-600">
                    <div class="flex items-center gap-1">
                      <i class="fa-solid fa-certificate text-secondary text-xs"></i>
                      <span>Certified</span>
                    </div>
                    <div class="flex items-center gap-1">
                      <i class="fa-solid fa-clock text-secondary text-xs"></i>
                      <span><?= $courseDurations[$index % count($courseDurations)] ?></span>
                    </div>
                  </div>

                  <div class="space-y-2 pt-2">
                    <div class="flex justify-between text-xs text-gray-500">
                      <span>Course Progress</span>
                      <span>65%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                      <div class="bg-gradient-to-r from-secondary-light/80 to-secondary h-2 rounded-full transition-all duration-1000 group-hover:w-[65%] w-[45%]"></div>
                    </div>
                  </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200 fade-up delay-<?= $index + 2 ?>">
                  <a href="<?= base_url('courses/' . $course->slug) ?>"
                    class="group/btn w-full bg-gradient-to-r from-primary to-primary-light text-white py-3 px-4 rounded-xl 
                           font-semibold flex items-center justify-center gap-2 hover:shadow-lg transition-all duration-300 
                           hover:scale-[1.02] text-sm btn-pulse">
                    <span>Explore Course</span>
                    <i class="fa-solid fa-arrow-right transition-transform duration-300 group-hover/btn:translate-x-1 text-xs"></i>
                  </a>
                </div>

                <div class="absolute inset-0 rounded-3xl border-2 border-transparent group-hover:border-primary/10 transition-all duration-500 pointer-events-none"></div>
              </div>

            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>

      <!-- Pagination -->
      <div class="swiper-pagination"></div>
    </div>
    <!-- ⭐ SWIPER END ⭐ -->

  </div>

  <!-- Background Elements -->
  <div class="absolute top-0 left-0 w-72 h-72 bg-primary/5 rounded-full -translate-x-1/2 -translate-y-1/2 blur-3xl"></div>
  <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary/5 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl"></div>
</section>
<script>
  var courseSwiper = new Swiper(".courseSwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    speed: 800,
    breakpoints: {
      0: {
        slidesPerView: 1
      },
      640: {
        slidesPerView: 1
      },
      1024: {
        slidesPerView: 2
      },
      1280: {
        slidesPerView: 3
      }
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });
</script>

<!-- ANIMATION STYLES -->
<style>
  /* Fade-up animation */
  @keyframes fadeUp {
    0% {
      opacity: 0;
      transform: translateY(28px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-up {
    opacity: 0;
    animation: fadeUp 1s ease-out forwards;
  }

  .delay-1 {
    animation-delay: .2s;
  }

  .delay-2 {
    animation-delay: .4s;
  }

  .delay-3 {
    animation-delay: .6s;
  }

  .delay-4 {
    animation-delay: .8s;
  }

  .delay-5 {
    animation-delay: 1s;
  }

  /* Zoom-in animation */
  @keyframes zoomFade {
    0% {
      opacity: 0;
      transform: scale(.9);
    }

    100% {
      opacity: 1;
      transform: scale(1);
    }
  }

  .zoom-in {
    animation: zoomFade 1s ease-out forwards;
  }

  /* Image hover animation */
  .image-hover:hover {
    transform: scale(1.05);
    transition: .4s ease;
  }

  /* Button hover micro-pulse */
  .btn-pulse:hover {
    transform: translateY(-2px) scale(1.03);
    transition: .3s ease;
  }
</style>

<!-- admission Section Wrapper -->
<section class="py-10 bg-white fade-in-section">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Section Header -->
    <?php if (!empty($admission_heading)): ?>
      <div class="text-center mb-10 fade-up delay-1">
        <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full 
                     font-semibold text-sm tracking-wider border border-secondary/20 mb-4 animate-badge"
          data-animate="fade-up" data-delay="100">
          <?= esc($admission_heading->subheading) ?>
        </span>

        <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-4 mb-[8rem] mx-auto max-w-2xl animate-title"
          data-animate="fade-up" data-delay="200">
          <?= esc($admission_heading->heading) ?>
          <div class="w-full flex items-center justify-center mt-2 gap-3">

            <!-- Left Gradient Line -->
            <div class="w-20 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

            <!-- Left Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Center Circle -->
            <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
              <span class="h-1 w-1 bg-primary rounded-full"></span>
            </span>

            <!-- Right Dot -->
            <span class="h-1 w-1 bg-primary rounded-full"></span>

            <!-- Right Gradient Line -->
            <div class="w-20 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

          </div>
        </h2>
      </div>
    <?php endif; ?>

    <!-- Process Steps -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12 lg:gap-4 mt-5">

      <?php if (!empty($admission_steps)): ?>
        <?php foreach ($admission_steps as $step): ?>

          <!-- Step Card -->
          <div class="group relative text-center opacity-0 admission-step"
            style="animation-delay: <?= ($step->step_number - 1) * 0.25 ?>s"
            data-animate="zoom-in" data-delay="<?= 300 + (($step->step_number - 1) * 100) ?>">

            <div class="flex flex-col items-center">

              <!-- Icon Container -->
              <div class="relative mb-6">
                <div class="dark:bg-primary-dark flex items-center justify-center shadow-lg border border-gray-200 dark:border-gray-700
                            transform transition-all duration-500 step-icon-box group-hover:scale-110 group-hover:rotate-3">

                  <div class="w-14 h-14 bg-gradient-primary rounded-md flex items-center justify-center animate-step-icon">
                    <i class="<?= esc($step->icon) ?> text-white text-lg"></i>
                  </div>

                  <!-- Step Number -->
                  <div class="absolute -top-2 -left-2 w-7 h-7 bg-secondary rounded-md flex items-center justify-center 
                              shadow-md transform transition-all duration-500 group-hover:scale-125 animate-bounce-subtle">
                    <span class="text-white text-sm font-bold"><?= esc($step->step_number) ?></span>
                  </div>
                </div>
              </div>

              <!-- Arrow Connector (Desktop) -->
              <?php if ($step->step_number != end($admission_steps)->step_number): ?>
                <div class="hidden lg:block absolute top-7 left-[80%] w-32 fade-up delay-1"
                  data-animate="fade-right" data-delay="<?= 400 + (($step->step_number - 1) * 100) ?>">
                  <div class="border-t-2 border-dashed border-gray-400 relative">
                    <span class="absolute -right-2 -top-2 opacity-70">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                      </svg>
                    </span>
                  </div>
                </div>
              <?php endif; ?>

              <!-- Text Box -->
              <div class="dark:bg-primary-dark rounded-2xl p-6 transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-1 animate-step-text"
                data-animate="fade-up" data-delay="<?= 500 + (($step->step_number - 1) * 100) ?>">
                <h3 class="text-primary dark:text-white text-xl font-bold mb-3"><?= esc($step->title) ?></h3>
                <p class="text-textbody-light dark:text-textbody-dark text-sm leading-relaxed">
                  <?= esc($step->description) ?>
                </p>
              </div>
            </div>
          </div>

        <?php endforeach; ?>
      <?php endif; ?>

    </div>

    <!-- CTA Button -->
    <div class="text-center mt-10 fade-up delay-2"
      data-animate="fade-up" data-delay="800">
      <a href="<?= base_url('admission') ?>"
        class="inline-block px-8 py-4 bg-secondary border-2 border-secondary-dark hover:border-primary-dark 
               text-white font-bold rounded-full shadow-lg hover:bg-primary transition-all duration-300 
               hover:scale-[1.05] relative overflow-hidden cta-shine">
        Learn More
      </a>
    </div>

  </div>
</section>

<!-- ANIMATION STYLES -->
<style>
  /* Fade up general */
  @keyframes fadeUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-up {
    animation: fadeUp 1s ease-out forwards;
    opacity: 0;
  }

  .delay-1 {
    animation-delay: .3s;
  }

  .delay-2 {
    animation-delay: .6s;
  }

  /* Title animation */
  @keyframes titlePop {
    0% {
      opacity: 0;
      transform: translateY(35px) scale(.95);
    }

    100% {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .animate-title {
    animation: titlePop 1s ease-out forwards;
    opacity: 0;
  }

  /* Badge slide */
  @keyframes badgeSlide {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-badge {
    animation: badgeSlide 0.8s ease-out forwards;
    opacity: 0;
  }

  /* Steps – unique pop with slight rotate */
  @keyframes stepIn {
    0% {
      opacity: 0;
      transform: translateY(40px) scale(.9) rotate(-3deg);
    }

    100% {
      opacity: 1;
      transform: translateY(0) scale(1) rotate(0deg);
    }
  }

  .admission-step {
    animation: stepIn .9s ease-out forwards;
  }

  /* Icon breathing + hover glow */
  @keyframes iconBreath {

    0%,
    100% {
      transform: scale(1);
    }

    50% {
      transform: scale(1.1);
    }
  }

  .animate-step-icon {
    animation: iconBreath 3s ease-in-out infinite;
  }

  /* Subtle bounce for number badge */
  @keyframes bounceSubtle {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(-3px);
    }
  }

  .animate-bounce-subtle {
    animation: bounceSubtle 2.2s ease-in-out infinite;
  }

  /* Step text entry */
  @keyframes textRise {
    0% {
      opacity: 0;
      transform: translateY(25px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-step-text {
    animation: textRise 1s ease-out forwards;
    opacity: 0;
  }

  /* CTA Shine Effect */
  .cta-shine::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    height: 100%;
    width: 50%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, .4), transparent);
    transform: skewX(-20deg);
    transition: 0.5s;
  }

  .cta-shine:hover::after {
    left: 120%;
  }
</style>

<!-- Testimonial Section -->
<section id="testimonials" class="py-10 scroll-mt-32 bg-graylight/50 fade-in-section">

  <div class="max-w-7xl mx-auto flex items-center justify-between mb-12 px-4">
    <div>
      <h4 class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4"
        data-animate="fade-up" data-delay="100">
        Testimonials
      </h4>

      <h2 class="text-4xl font-bold text-primary mt-2"
        data-animate="fade-up" data-delay="200">
        <?= esc($testimonial_heading->heading) ?>
        <div class="w-full flex items-center mt-2 gap-3">

          <!-- Left Gradient Line -->
          <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

          <!-- Left Dot -->
          <span class="h-1 w-1 bg-primary rounded-full"></span>

          <!-- Center Circle -->
          <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
            <span class="h-1 w-1 bg-primary rounded-full"></span>
          </span>

          <!-- Right Dot -->
          <span class="h-1 w-1 bg-primary rounded-full"></span>

          <!-- Right Gradient Line -->
          <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

        </div>
      </h2>
    </div>

    <div class="flex gap-4">
      <button id="prev-btn" class="w-12 h-12 bg-gradient-to-r from-primary-light to-primary-dark text-white flex items-center justify-center rounded-full"
        data-animate="fade-left" data-delay="300">
        &#8592;
      </button>
      <button id="next-btn" class="w-12 h-12 bg-gradient-to-r from-primary-light to-primary-dark text-white flex items-center justify-center rounded-full"
        data-animate="fade-right" data-delay="300">
        &#8594;
      </button>
    </div>

  </div>

  <!-- Testimonial Track -->
  <div class="relative max-w-7xl mx-auto">
    <div class="overflow-hidden">
      <div id="testimonial-track" class="flex transition-all duration-500 p-8 gap-8">

        <?php foreach ($testimonials as $t): ?>
          <div class="testimonial-slide flex flex-shrink-0 rounded-lg overflow-hidden"
            data-animate="zoom-in" data-delay="<?= 400 + (array_search($t, $testimonials) * 100) ?>">

            <!-- IMAGE -->
            <div class="image-wrapper flex items-center justify-center p-6 bg-white rounded-l-full">
              <div class="relative w-40 h-40 flex items-center justify-center">
                <div class="absolute inset-0 rounded-full border-2 border-secondary opacity-60 scale-110"></div>
                <img src="<?= base_url('assets/img/testimonials/' . $t->image) ?>"
                  class="w-36 h-36 rounded-full object-cover relative z-10">
              </div>
            </div>

            <!-- CONTENT -->
            <div class="flex flex-col justify-center bg-white p-6 rounded-r-lg relative w-full">
              <div class="absolute top-4 right-4 text-primary-light/20 text-6xl">
                <i class="fas fa-quote-right"></i>
              </div>

              <h3 class="text-xl font-bold"><?= esc($t->name) ?></h3>
              <p class="text-secondary font-medium"><?= esc($t->designation) ?></p>
              <p class="text-textbody-light mt-2">"<?= esc($t->feedback) ?>"</p>
            </div>

          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>

</section>

<script>
  let currentSlide = 0;
  const track = document.getElementById("testimonial-track");
  const slides = document.querySelectorAll(".testimonial-slide");
  const totalSlides = slides.length;

  function updateSlider() {
    // Desktop = 2 cards → slide 50% per move
    // Mobile = 1 card → slide 100% per move
    const slideWidth = window.innerWidth <= 768 ? 100 : 50;

    track.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
  }

  document.getElementById("next-btn").addEventListener("click", () => {
    const maxIndex = window.innerWidth <= 768 ?
      totalSlides - 1 // mobile: 1-by-1
      :
      totalSlides - 2; // desktop: 2 visible at once

    if (currentSlide < maxIndex) {
      currentSlide++;
    } else {
      currentSlide = 0; // loop back
    }

    updateSlider();
  });

  document.getElementById("prev-btn").addEventListener("click", () => {
    const maxIndex = window.innerWidth <= 768 ?
      totalSlides - 1 :
      totalSlides - 2;

    if (currentSlide > 0) {
      currentSlide--;
    } else {
      currentSlide = maxIndex;
    }

    updateSlider();
  });

  // Recalculate on resize
  window.addEventListener("resize", updateSlider);
</script>

<style>
  /* Mobile: make each card full-width & remove image spacing */
  @media (max-width: 768px) {
    .mobile-mx-5 {
      margin-left: 1.25rem !important;
      /* mx-5 = 1.25rem */
      margin-right: 1.25rem !important;
    }
  }

  @media (max-width: 768px) {
    #testimonial-track>div {
      width: 100% !important;
    }

    /* Make content card fully rounded */
    #testimonial-track>div>div.flex-col {
      border-radius: 12px !important;
      padding: 1.5rem !important;
      width: 100% !important;
    }
  }

  /* Desktop: each card takes 50% width (2 cards visible) */
  .testimonial-slide {
    width: 50%;
  }

  /* Mobile: show 1 card only */
  @media (max-width: 768px) {
    .testimonial-slide {
      width: 100% !important;
    }

    .image-wrapper {
      display: none !important;
      width: 0 !important;
      padding: 0 !important;
    }

    .testimonial-slide>div.flex-col {
      border-radius: 12px !important;
      padding: 1.5rem !important;
      width: 100% !important;
    }

    #testimonial-track .fa-quote-right {
      right: 10px !important;
      top: 10px !important;
    }
  }
</style>

<!-- Custom Animations -->
<style>
  @keyframes fadeSlideUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fade-slide-up {
    animation: fadeSlideUp 0.8s ease-out forwards;
    opacity: 0;
  }

  .delay-100 {
    animation-delay: 0.1s;
  }

  .delay-200 {
    animation-delay: 0.2s;
  }

  .delay-300 {
    animation-delay: 0.3s;
  }
</style>

<section class="bg-white py-16 fade-in-section">
  <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2">

    <!-- LEFT SIDE: IMAGE + OVERLAY CARD -->
    <div class="relative flex justify-end group">
      <!-- Background Image with Overlay -->
      <div class="relative w-full lg:w-[90%] overflow-hidden rounded-l-xl">
        <img
          src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?auto=format&fit=crop&w=1200&q=80"
          class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700"
          alt="modern office" />
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      </div>

      <!-- Floating Contact Card -->
      <div class="hidden lg:block absolute top-1/2 -left-8 -translate-y-1/2 
                  bg-background-light dark:bg-primary-dark shadow-2xl rounded-2xl p-8 w-72 
                  border border-gray-100 dark:border-gray-800
                  transition-all duration-500"
        data-animate="fade-left" data-delay="300">

        <h3 class="font-heading text-primary dark:text-white text-xl font-bold mb-6 flex items-center gap-2">
          <div class="w-2 h-6 bg-secondary rounded-full"></div>
          Contact Info
        </h3>

        <div class="space-y-5">
          <!-- Location -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 dark:bg-secondary/20 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary dark:text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light dark:text-heading-dark text-sm">Location</p>
              <p class="text-textbody-light dark:text-textbody-dark text-sm mt-1"><?= esc($contact_info->location) ?></p>
            </div>
          </div>

          <!-- Phone -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 dark:bg-secondary/20 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary dark:text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light dark:text-heading-dark text-sm">Phone</p>
              <p class="text-textbody-light dark:text-textbody-dark text-sm mt-1"><?= esc($contact_info->phone) ?></p>
            </div>
          </div>

          <!-- Email -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 dark:bg-secondary/20 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary dark:text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light dark:text-heading-dark text-sm">Email</p>
              <p class="text-textbody-light dark:text-textbody-dark text-sm mt-1"><?= esc($contact_info->email) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT SIDE: FORM -->
    <div class="flex animate-slide-in-right">
      <form action="<?= base_url('submit-contact') ?>" method="post"
        class="w-full max-w-md bg-graylight dark:bg-gray-800 shadow-2xl rounded-r-2xl p-8 
             border border-gray-100 dark:border-gray-700">

        <?= csrf_field() ?>

        <div class="mb-8">
          <h2 class="font-heading text-primary dark:text-white text-3xl font-bold mb-8"
            data-animate="fade-up" data-delay="100">Contact Form
            <div class="w-full flex items-center mt-2 gap-3">

              <!-- Left Gradient Line -->
              <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

              <!-- Left Dot -->
              <span class="h-1 w-1 bg-primary rounded-full"></span>

              <!-- Center Circle -->
              <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                <span class="h-1 w-1 bg-primary rounded-full"></span>
              </span>

              <!-- Right Dot -->
              <span class="h-1 w-1 bg-primary rounded-full"></span>

              <!-- Right Gradient Line -->
              <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

            </div>
          </h2>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
          <div class="bg-green-500 text-white p-3 rounded mb-4">
            <?= session()->getFlashdata('success') ?>
          </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
          <div class="bg-red-500 text-white p-3 rounded mb-4">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>

        <div class="space-y-5">

          <div class="group">
            <input type="text" name="full_name" placeholder="Full Name"
              required
              class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4"
              data-animate="fade-up" data-delay="400" />
          </div>

          <div class="group">
            <input type="email" name="email" placeholder="Email"
              required
              class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4"
              data-animate="fade-up" data-delay="500" />
          </div>

          <div class="group">
            <input type="text" name="phone" placeholder="Phone Number"
              class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4"
              data-animate="fade-up" data-delay="600" />
          </div>

          <div class="group">
            <input type="text" name="subject" placeholder="Subject"
              class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4"
              data-animate="fade-up" data-delay="700" />
          </div>

          <div class="group">
            <textarea name="message" placeholder="Your Message" rows="4"
              class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4"
              data-animate="fade-up" data-delay="800"></textarea>
          </div>

        </div>

        <button class="mt-8 w-full bg-gradient-primary text-white py-4 rounded-xl"
          data-animate="fade-up" data-delay="900">
          Send Message
        </button>

      </form>
    </div>
  </div>
</section>

<section class="py-10 bg-graylight/40 fade-in-section">
  <div class="max-w-7xl mx-auto px-4">

    <!-- Centered Heading -->
    <div class="text-center mb-12">
      <h4 class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4"
        data-animate="fade-up" data-delay="100">
        Our Blog
      </h4>

      <h2 class="text-4xl font-bold text-primary"
        data-animate="fade-up" data-delay="200">
        <?= esc($blog_heading) ?>
        <div class="w-full flex items-center justify-center mt-2 gap-3">

          <!-- Left Gradient Line -->
          <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>

          <!-- Left Dot -->
          <span class="h-1 w-1 bg-primary rounded-full"></span>

          <!-- Center Circle -->
          <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
            <span class="h-1 w-1 bg-primary rounded-full"></span>
          </span>

          <!-- Right Dot -->
          <span class="h-1 w-1 bg-primary rounded-full"></span>

          <!-- Right Gradient Line -->
          <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>

        </div>
      </h2>
    </div>

    <!-- BLOG GRID -->
    <div class="grid md:grid-cols-3 gap-8">

      <?php foreach ($blogs as $item): ?>

        <?php
        // Format date
        $timestamp = strtotime($item->post_date);
        $day   = date('d', $timestamp);
        $month = date('M', $timestamp);
        ?>

        <article class="bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-2xl transition-all"
          data-animate="fade-up" data-delay="<?= 300 + (array_search($item, $blogs) * 100) ?>">
          <!-- Image -->
          <div class="relative">
            <img src="<?= base_url('assets/img/blog/' . $item->image) ?>"
              alt="<?= esc($item->title) ?>"
              class="w-full h-60 object-cover">

            <!-- Date Badge -->
            <div class="absolute -bottom-6 right-6 bg-white shadow-md rounded-lg px-4 py-2 text-center border-b-4 border-secondary">
              <p class="text-2xl font-bold text-primary"><?= $day ?></p>
              <p class="text-sm text-secondary -mt-1"><?= $month ?></p>
            </div>
          </div>

          <!-- Content -->
          <div class="pt-10 pb-6 px-6">

            <!-- Meta Row -->
            <div class="flex items-center gap-6 text-textbody-light text-sm mb-4">
              <span class="flex items-center gap-2">
                <i class="fas fa-tag text-secondary-light"></i>
                <?= esc($item->category) ?>
              </span>

              <span class="flex items-center gap-2">
                <i class="fas fa-clock text-secondary-light"></i>
                <?= esc($item->reading_time) ?> min read
              </span>
            </div>

            <!-- Title -->
            <a href="<?= base_url('blog/' . $item->slug) ?>"
              class="block text-heading-light text-xl font-semibold leading-snug hover:text-secondary-dark transition">
              <?= esc($item->title) ?>
            </a>

            <!-- Short excerpt -->
            <p class="text-textbody-light mt-3">
              <?= esc($item->content) ?>
            </p>

            <!-- Read More -->
            <div class="flex items-center justify-end mt-6">
              <div class="flex-1 border-b border-gray-300 mr-6"></div>
              <a href="<?= base_url('blog/' . $item->slug) ?>"
                class="flex items-center gap-3 text-primary-light hover:text-secondary font-semibold hover:gap-4 transition-all">
                <span class="text-2xl">→</span>
                <span>Read More</span>
              </a>
            </div>
          </div>
        </article>

      <?php endforeach; ?>

    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const elements = document.querySelectorAll('.fade-in-section');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {

        // If element is visible on screen
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
        } else {
          // Remove class when going out of screen to re-animate again
          entry.target.classList.remove('is-visible');
        }
      });
    }, {
      threshold: 0.2
    });

    elements.forEach(el => observer.observe(el));
  });
</script>

<?= $this->endSection() ?>