<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<style>
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

<!-- Full-Background Slider Section -->
<section class="relative w-full min-h-screen overflow-hidden">

  <!-- Animated Background Shapes -->
  <div class="absolute inset-0 -z-10 pointer-events-none">
    <div class="absolute w-96 h-96 bg-gradient-primary rounded-full opacity-30 animate-spin-slow top-10 left-10"></div>
    <div class="absolute w-72 h-72 bg-primary/20 rounded-full animate-pulse-slow bottom-20 right-16"></div>
  </div>

  <div class="swiper professionalSlider w-full h-full relative z-10">
    <div class="swiper-wrapper">

      <?php foreach ($hero_slides as $index => $slide): ?>
        <div class="swiper-slide relative w-full h-full pt-16 pb-24">

          <!-- Background Image + Gradient Overlay -->
          <div class="absolute inset-0 bg-cover bg-center lazy-bg"
            data-bg="<?= base_url("assets/img/home/" . $slide->bg_shape_image) ?>"
            style="background-image:
            linear-gradient(to right, rgba(15,61,95,0.85), rgba(15,61,95,0.4), rgba(15,61,95,0)),
            url('hero-img');">
          </div>

          <div class="h-full flex flex-col justify-center items-start px-6 sm:px-12 lg:px-24 relative z-10">

            <!-- Number Badge (Dynamic 1,2,3) -->
            <div class="flex items-center gap-4 mb-6 opacity-0 slide-animate">
              <div class="text-5xl font-light text-white/60 tracking-tight">
                <?= $index + 1 ?>
              </div>
              <div class="w-16 h-px bg-white/40"></div>
              <div class="text-sm font-medium text-white/70 tracking-wider uppercase">
                <?= $slide->tagline ?>
              </div>
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl lg:text-4xl max-w-4xl font-serif font-bold text-white mb-3 leading-tight opacity-0 slide-animate">
              <?= $slide->title ?>
            </h1>

            <!-- Divider -->
            <div class="w-32 h-1 bg-secondary mb-6 opacity-0 slide-animate"></div>

            <!-- Description -->
            <p class="text-md md:text-md text-white mb-6 max-w-3xl text-justify leading-relaxed opacity-0 slide-animate">
              <?= $slide->description ?>
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 mb-8 opacity-0 slide-animate">
              <div class="border-l-2 border-white/50 pl-4 py-2">
                <div class="text-2xl font-bold text-white">95%</div>
                <div class="text-xs text-white/70 uppercase tracking-wider">Success Rate</div>
              </div>
              <div class="border-l-2 border-white/50 pl-4 py-2">
                <div class="text-2xl font-bold text-white">2500+</div>
                <div class="text-xs text-white/70 uppercase tracking-wider">Students</div>
              </div>
              <div class="border-l-2 border-white/50 pl-4 py-2">
                <div class="text-2xl font-bold text-white">15+</div>
                <div class="text-xs text-white/70 uppercase tracking-wider">Programs</div>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 opacity-0 slide-animate">
              <a href="<?= $slide->btn1 ?>"
                class="group relative px-8 py-4 
          bg-gradient-to-r from-primary to-secondary 
          text-white font-medium rounded-lg shadow-lg 
          hover:scale-105 transition-all duration-300 overflow-hidden">
                <span class="relative z-10 flex items-center gap-2">
                  <?= $slide->btn_text_1 ?>
                  <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                </span>
              </a>

              <a href="<?= $slide->btn2 ?>"
                class="px-8 py-4 border-2 border-white text-white font-medium rounded-lg hover:bg-primary hover:border-primary transition-all duration-300 flex items-center gap-2">
                <?= $slide->btn_text_2 ?>
                <i class="fas fa-external-link-alt text-xs"></i>
              </a>
            </div>

          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Navigation Dots -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex items-center gap-6 z-30">
      <?php foreach ($hero_slides as $index => $slide): ?>
        <button class="professional-dot w-8 h-0.5 bg-white/40 hover:bg-white transition-all duration-300"
          data-slide="<?= $index ?>"
          aria-label="Go to slide <?= $index + 1 ?>"></button>
      <?php endforeach; ?>
    </div>

    <!-- Navigation Arrows -->
    <div class="absolute top-1/2 left-0 right-0 justify-between px-6 z-30 hidden sm:flex">
      <button class="professional-prev w-10 h-10 border border-white bg-white rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
        <i class="fas fa-chevron-left text-sm"></i>
      </button>
      <button class="professional-next w-10 h-10 border border-white bg-white rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all duration-300">
        <i class="fas fa-chevron-right text-sm"></i>
      </button>
    </div>

  </div>
</section>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const lazyBg = document.querySelectorAll(".lazy-bg");
    lazyBg.forEach(el => {
      const img = new Image();
      img.src = el.dataset.bg;
      img.onload = () => {
        el.style.backgroundImage =
          `linear-gradient(to right, rgba(15,61,95,0.85), rgba(15,61,95,0.4), rgba(15,61,95,0)), url('${el.dataset.bg}')`;
      };
    });
  });
</script>
<style>
  .font-serif {
    font-family: 'Playfair Display', serif;
  }

  /* Slide smooth animation */
  @keyframes slideFadeUp {
    0% {
      opacity: 0;
      transform: translateY(40px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .slide-animate {
    opacity: 0;
    animation: slideFadeUp 1s ease forwards;
  }

  .animate-spin-slow {
    animation: spin-slow 90s linear infinite;
  }

  @keyframes spin-slow {
    100% {
      transform: rotate(360deg);
    }
  }

  .animate-pulse-slow {
    animation: pulse-slow 6s ease-in-out infinite;
  }

  @keyframes pulse-slow {

    0%,
    100% {
      opacity: .5;
    }

    50% {
      opacity: 1;
    }
  }

  /* Active dot */
  .professional-dot.active {
    width: 32px;
    background: #fff;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.professionalSlider', {
      effect: 'fade',
      fadeEffect: {
        crossFade: true
      },
      speed: 900,
      loop: true,
      autoplay: {
        delay: 6000,
        disableOnInteraction: false
      },
      navigation: {
        nextEl: '.professional-next',
        prevEl: '.professional-prev'
      },
      on: {
        init() {
          updateDots(this);
          animateSlide(this.slides[this.activeIndex]);
        },
        slideChange() {
          updateDots(this);
        },
        slideChangeTransitionStart() {
          resetAnimations(this);
        },
        slideChangeTransitionEnd() {
          animateSlide(this.slides[this.activeIndex]);
        }
      }
    });

    function updateDots(swiperInstance) {
      document.querySelectorAll('.professional-dot').forEach((dot, index) => {
        dot.classList.toggle('active', index === swiperInstance.realIndex);
        dot.onclick = () => swiper.slideToLoop(index);
      });
    }

    function animateSlide(slide) {
      const elements = slide.querySelectorAll('.slide-animate');
      elements.forEach((el, i) => {
        el.style.animationDelay = `${i * 0.1}s`;
        el.classList.remove('opacity-0');
      });
    }

    function resetAnimations(swiperInstance) {
      swiperInstance.slides.forEach(slide => {
        slide.querySelectorAll('.slide-animate').forEach(el => {
          el.style.animation = 'none';
          el.style.opacity = 0;

          // Fix: Use requestAnimationFrame instead of offsetHeight
          requestAnimationFrame(() => {
            el.style.animation = null;
          });
        });
      });
    }
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

    <!-- Main Section Heading -->
    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-primary leading-snug">
        <?= ($about->heading) ?>
        <div class="w-full flex items-center justify-center md:justify-start mt-2 gap-3">
            <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>
            <span class="h-1 w-1 bg-primary rounded-full"></span>
            <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                <span class="h-1 w-1 bg-primary rounded-full"></span>
            </span>
            <span class="h-1 w-1 bg-primary rounded-full"></span>
            <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>
        </div>
    </h2>

    <p class="text-gray-600 leading-relaxed text-sm sm:text-base text-justify">
        <?= ($about->description) ?>
    </p>

    <div class="grid sm:grid-cols-2 gap-4 sm:gap-6 pt-4">

        <!-- Feature 1 -->
        <?php if (!empty($about->feature1_icon)): ?>
            <?php for ($i = 0; $i < count($about->feature1_icon); $i++): ?>
                <div class="flex items-start gap-3 sm:gap-4">
                    <div class="bg-[#E8EEF7] rounded-lg p-1.5">
                        <i class="<?= esc($about->feature1_icon[$i]) ?> text-primary text-lg sm:text-lg"></i>
                    </div>

                    <div>
                        <!-- Use h3 for feature titles instead of h5 -->
                        <h3 class="font-semibold text-gray-900 text-sm sm:text-lg">
                            <?= esc($about->feature1_title[$i]) ?>
                        </h3>
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
            <span class="sr-only">about <?= esc($about->heading) ?></span>
        </a>
        <div class="flex items-center gap-3 sm:gap-4">
            <img src="<?= base_url('assets/img/about/' . $about->instructor_image) ?>"
                 alt="Instructor"
                 class="w-12 sm:w-16 h-12 sm:h-16 rounded-full object-cover shadow">
            <div>
                <p class="text-xs sm:text-sm text-primary"><?= esc($about->instructor_title) ?></p>
                <!-- Use h3 instead of h4 for instructor name to follow hierarchy -->
                <h3 class="font-semibold text-gray-900 text-sm sm:text-base"><?= esc($about->instructor_name) ?></h3>
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
<section class="py-10 bg-graylight relative overflow-hidden fade-in-section">
  <div class="container mx-auto px-6 lg:px-12 fade-up delay-1">
    <!-- Section Header -->
    <div class="text-center mb-16 fade-up delay-2">
      <?php if (!empty($course_subheading)): ?>
        <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4 fade-up delay-1">
          <?= esc($course_subheading) ?>
        </span>
      <?php endif; ?>
      <?php if (!empty($course_heading)): ?>
        <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-4 fade-up delay-2">
          <?= esc($course_heading) ?>
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
          <?php foreach ($courses as $index => $course): ?>
            <div class="swiper-slide">
              <div class="group relative bg-white rounded-3xl mt-16 pt-32 pb-8 px-6 shadow-lg hover:shadow-2xl 
                transition-all duration-500 border border-gray-100 hover:border-primary/20 overflow-visible fade-up"
                data-animate="fade-up" data-delay="<?= 300 + ($index * 100) ?>">

                <!-- Image -->
                <div class="absolute -top-12 left-1/2 transform -translate-x-1/2 w-[95%] rounded-2xl overflow-hidden shadow-xl">
                  <img src="<?= base_url('assets/img/courses/' . ($course->image ?? 'default.png')) ?>"
                    alt="<?= esc($course->title) ?>"
                    class="w-full h-40 object-cover transition-transform duration-700 group-hover:scale-110">
                  <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                </div>

                <!-- Icon -->
                <div class="absolute top-20 right-6 bg-white text-primary rounded-2xl p-3 shadow-xl border border-gray-100 
                    transition-all duration-500 group-hover:bg-secondary group-hover:text-white 
                    group-hover:scale-110 z-10">
                  <i class="<?= esc($course->icon) ?> text-xl"></i>
                </div>

                <!-- Content -->
                <div class="mt-8 space-y-2">

                  <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-widest"><?= esc($course->category) ?></span>

                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs font-medium">
                      <?= esc($course->level) ?>
                    </span>
                  </div>

                  <h3 class="text-lg font-bold text-primary group-hover:text-primary-dark transition-colors duration-300 leading-tight min-h-[40px]">
                    <?= esc($course->title) ?>
                  </h3>

                  <!-- Duration -->
                  <div class="flex items-center justify-between text-sm text-gray-600">
                    <div class="flex items-center gap-1">
                      <i class="fa-solid fa-certificate text-secondary text-xs"></i>
                      <span>Certified</span>
                    </div>
                    <div class="flex items-center gap-1">
                      <i class="fa-solid fa-clock text-secondary text-xs"></i>
                      <span><?= esc($course->duration) ?></span>
                    </div>
                  </div>

                  <!-- Progress Bar -->
                  <div class="space-y-2 pt-2">
                    <div class="flex justify-between text-xs text-gray-500">
                      <span>Course Progress</span>
                      <span><?= esc($course->progress) ?>%</span>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2">
                      <div class="bg-gradient-to-r from-secondary-light/80 to-secondary h-2 rounded-full 
                                transition-all duration-1000 w-[<?= esc($course->progress) ?>%]">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                  <a href="<?= base_url('courses/' . $course->slug) ?>"
                    class="group/btn w-full bg-gradient-to-r from-primary to-primary-light text-white py-3 px-4 rounded-xl 
                      font-semibold flex items-center justify-center gap-2 hover:shadow-lg transition-all duration-300 
                      hover:scale-[1.02] text-sm">
                    <span>Explore Course</span>
                    <i class="fa-solid fa-arrow-right transition-transform duration-300 group-hover/btn:translate-x-1 text-xs"></i>
                  </a>
                </div>

                <div class="absolute inset-0 rounded-3xl border-2 border-transparent group-hover:border-primary/10 
                    transition-all duration-500 pointer-events-none"></div>
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
  const courseSwiper = new Swiper(".courseSwiper", {
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
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true
    },
    // Prevent forced reflow: use `observer` only if dynamic content changes
    observer: true,
    observeParents: true,
  });
</script>

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

  /* Delays */
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

  /* Image hover */
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

        <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-4 mb-[4rem] mx-auto max-w-2xl animate-title"
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
          <div class="group relative text-center opacity-0 admission-step h-full flex flex-col"
            style="animation-delay: <?= ($step->step_number - 1) * 0.25 ?>s">

            <div class="flex flex-col items-center h-full">

              <!-- Icon -->
              <div class="relative mb-6">
                <div class="flex items-center justify-center shadow-lg border border-gray-200
                        transform transition-all duration-500 step-icon-box group-hover:scale-110 group-hover:rotate-3">

                  <div class="w-14 h-14 bg-gradient-primary rounded-md flex items-center justify-center">
                    <i class="<?= esc($step->icon) ?> text-white text-lg"></i>
                  </div>

                  <div class="absolute -top-2 -left-2 w-7 h-7 bg-secondary rounded-md flex items-center justify-center shadow-md">
                    <span class="text-white text-sm font-bold"><?= esc($step->step_number) ?></span>
                  </div>
                </div>
              </div>
              <?php if ($step->step_number != end($admission_steps)->step_number): ?>
                <div class="hidden lg:block absolute top-7 left-[80%] w-32 fade-up delay-1"
                  data-animate="fade-right" data-delay="400">
                  <div class="border-t-2 border-dashed border-gray-400 relative">
                    <span class="absolute -right-2 -top-2 opacity-70">
                      <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                      </svg>
                    </span>
                  </div>
                </div>
              <?php endif; ?>

              <!-- Text Box (Equal Height for All Cards) -->
              <div class="rounded-2xl p-6 flex flex-col flex-grow h-full
                    transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-1">

                <h3 class="text-primary text-xl font-bold mb-3"><?= esc($step->title) ?></h3>

                <p class="text-textbody-light text-sm leading-relaxed flex-grow text-justify line-clamp-5">
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
      data-animate="fade-up" data-delay="800" aria-label="Learn more about admission process">
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
              <p class="text-textbody-light mt-2 text-justify">"<?= esc($t->feedback) ?>"</p>
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

  let slideWidthDesktop = 0;
  let slideWidthMobile = 0;

  // Cache widths once per resize
  function cacheWidths() {
    if (slides.length > 0) {
      slideWidthMobile = slides[0].offsetWidth; // 1 card width
      slideWidthDesktop = slides[0].offsetWidth / 2; // slide 50% per move
    }
  }
  cacheWidths();
  window.addEventListener("resize", cacheWidths);

  function updateSlider() {
    // Use requestAnimationFrame to batch DOM writes
    window.requestAnimationFrame(() => {
      const slideWidth = window.innerWidth <= 768 ? slideWidthMobile : slideWidthDesktop;
      track.style.transform = `translateX(-${currentSlide * slideWidth}px)`;
    });
  }

  document.getElementById("next-btn").addEventListener("click", () => {
    const maxIndex = window.innerWidth <= 768 ? totalSlides - 1 : totalSlides - 2;
    currentSlide = currentSlide < maxIndex ? currentSlide + 1 : 0;
    updateSlider();
  });

  document.getElementById("prev-btn").addEventListener("click", () => {
    const maxIndex = window.innerWidth <= 768 ? totalSlides - 1 : totalSlides - 2;
    currentSlide = currentSlide > 0 ? currentSlide - 1 : maxIndex;
    updateSlider();
  });
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
                  bg-background-light shadow-2xl rounded-2xl p-8 w-72 
                  border border-gray-100
                  transition-all duration-500"
        data-animate="fade-left" data-delay="300">

        <h3 class="font-heading text-primary text-xl font-bold mb-6 flex items-center gap-2">
          <div class="w-2 h-6 bg-secondary rounded-full"></div>
          Contact Info
        </h3>

        <div class="space-y-5">
          <!-- Location -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light text-sm">Location</p>
              <p class="text-textbody-light text-sm mt-1"><?= esc($contact_info->location) ?></p>
            </div>
          </div>

          <!-- Phone -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light text-sm">Phone</p>
              <p class="text-textbody-light text-sm mt-1"><?= esc($contact_info->phone) ?></p>
            </div>
          </div>

          <!-- Email -->
          <div class="flex items-start gap-3 group/item">
            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center 
                        group-hover/item:bg-primary/20 transition-colors duration-300">
              <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <p class="font-medium text-heading-light text-sm">Email</p>
              <p class="text-textbody-light text-sm mt-1"><?= esc($contact_info->email) ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RIGHT SIDE: FORM -->
    <div class="flex animate-slide-in-right">
      <form action="<?= base_url('submit-contact') ?>" method="post"
        class="w-full max-w-md bg-graylight shadow-2xl rounded-r-2xl p-8 
             border border-gray-100">

        <?= csrf_field() ?>

        <div class="mb-8">
          <h2 class="font-heading text-primary text-3xl font-bold mb-8"
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
              class="w-full border border-gray-300 rounded-xl p-4"
              data-animate="fade-up" data-delay="400" />
          </div>

          <div class="group">
            <input type="email" name="email" placeholder="Email"
              required
              class="w-full border border-gray-300 rounded-xl p-4"
              data-animate="fade-up" data-delay="500" />
          </div>

          <div class="group">
            <input type="text" name="phone" placeholder="Phone Number"
              class="w-full border border-gray-300 rounded-xl p-4"
              data-animate="fade-up" data-delay="600" />
          </div>

          <div class="group">
            <input type="text" name="subject" placeholder="Subject"
              class="w-full border border-gray-300 rounded-xl p-4"
              data-animate="fade-up" data-delay="700" />
          </div>

          <div class="group">
            <textarea name="message" placeholder="Your Message" rows="4"
              class="w-full border border-gray-300 rounded-xl p-4"
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
      <h3 class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4"
        data-animate="fade-up" data-delay="100">
        Our Blog
      </h3>

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
            <p class="text-textbody-light mt-3 text-justify">
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