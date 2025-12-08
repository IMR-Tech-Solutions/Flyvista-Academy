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
</style>

<!-- Breadcrumb Hero Section -->
<section class="relative w-full h-48 md:h-[18rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/30"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'About Us' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>

            <span class="text-white">➤</span>

            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'About' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

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
                <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold tracking-wider border border-secondary/20 text-xs sm:text-sm">
                    <?= $about->tag_text ?>
                </span>

                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-primary leading-snug">
                    <?= ($about->heading) ?>
                    <div class="w-full flex items-center mt-2 gap-3 justify-center sm:justify-start">

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
                                <div class="bg-[#E8EEF7] p-1.5 sm:p-1.5 rounded-lg">
                                    <i class="<?= esc($about->feature1_icon[$i]) ?> text-primary text-lg sm:text-lg"></i>
                                </div>

                                <div>
                                    <h5 class="font-semibold text-gray-900 text-sm sm:text-lg">
                                        <?= esc($about->feature1_title[$i]) ?>
                                    </h5>
                                </div>
                            </div>
                        <?php endfor; ?>
                    <?php endif; ?>

                </div>

                <div class="flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-8 pt-6">
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

<section class="py-12 bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl shadow-lg fade-in-section">
    <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

        <!-- LEFT CONTENT -->
        <div class="space-y-6">

            <!-- Section Label -->
            <p class="uppercase inline-block px-6 py-2 bg-secondary/20 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/30 mb-2 shadow-sm">
                Our Vision & Mission
            </p>

            <!-- Main Heading -->
            <h2 class="text-3xl md:text-4xl font-bold text-primary leading-tight relative">
                <?= esc($missionVision->heading ?? "Our Mission & Vision") ?>
                <div class="w-full flex items-center gap-3 mt-3">

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

            <!-- MISSION -->
            <div class="flex gap-5 py-6 border-l-4 rounded-lg border-primary pl-6 bg-white/70 shadow-sm">
                <div class="text-primary text-4xl flex items-center">
                    <i class="fa-solid fa-bullseye"></i>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-heading-light">Our Mission</h3>
                    <p class="text-textbody-light mt-1 text-justify pr-6">
                        <?= ($missionVision->mission_description ?? "") ?>
                    </p>
                </div>
            </div>

            <!-- VISION -->
            <div class="flex gap-5 py-6 border-l-4 border-primary rounded-lg pl-6 bg-white/70 shadow-sm">
                <div class="text-primary text-4xl flex items-center">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-heading-light">Our Vision</h3>
                    <p class="text-textbody-light mt-1 text-justify pr-6">
                        <?= ($missionVision->vision_description ?? "") ?>
                    </p>
                </div>
            </div>

            <!-- CORE VALUES -->
            <div class="flex gap-5 py-6 border-l-4 rounded-lg border-primary pl-6 bg-white/70 shadow-sm">
                <div class="text-primary text-4xl flex items-center">
                    <i class="fa-solid fa-handshake"></i>
                </div>

                <div>
                    <h3 class="text-xl font-semibold text-heading-light">
                        <?= esc($missionVision->core_values_title ?? "Core Values") ?>
                    </h3>
                    <p class="text-textbody-light mt-1 text-justify pr-6">
                        <?= ($missionVision->core_values_description ?? "") ?>
                    </p>
                </div>
            </div>

        </div>

        <!-- RIGHT IMAGES -->
        <div class="relative w-full flex flex-col">

            <!-- TOP IMAGE -->
            <div class="relative z-20 w-[80%] mr-auto -mb-20 animate-fade-up delay-200">
                <img
                    src="<?= base_url('assets/img/mission-vision/' . ($missionVision->top_image ?? 'default.jpg')) ?>"
                    class="w-full object-cover border-4 border-white rounded-xl shadow-lg">

                <!-- Circle Badge -->
                <div class="absolute -right-6 -bottom-1 bg-gradient-primary text-white rounded-full w-32 h-32 flex flex-col items-center justify-center shadow-xl animate-fade-up delay-300">
                    <span class="text-sm"><?= esc($missionVision->badge_title ?? "Trusted By") ?></span>
                    <span class="text-3xl font-bold"><?= esc($missionVision->badge_count ?? "0") ?>+</span>
                </div>
            </div>

            <!-- BOTTOM IMAGE -->
            <div class="relative z-10 w-full animate-fade-up delay-500">
                <img
                    src="<?= base_url('assets/img/mission-vision/' . ($missionVision->bottom_image ?? 'default.jpg')) ?>"
                    class="w-full object-cover rounded-xl shadow-lg">
            </div>
        </div>
    </div>
</section>

<!-- Add Animation Keyframes -->
<style>
    @keyframes fade-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fade-up 0.9s ease-out both;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }
</style>

<section class="py-16 bg-white fade-in-section">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        <!-- LEFT: STATIC AVIATION IMAGE -->
        <div class="relative">
            <img
                src="<?= base_url('assets/img/why-choose.png') ?>"
                alt="Aviation Training"
                class="rounded-2xl shadow-xl object-cover w-full h-[420px]">

            <div class="absolute inset-0 bg-primary/20 rounded-2xl mix-blend-multiply"></div>
        </div>

        <!-- RIGHT: DYNAMIC CONTENT -->
        <?php if (!empty($whyChoose)): ?>
            <div class="space-y-6">

                <!-- Heading -->
                <p class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full 
                           font-semibold text-sm tracking-wider border border-secondary/20 shadow-sm">
                    Why Choose Us
                </p>

                <!-- Title -->
                <h2 class="text-3xl md:text-4xl font-bold text-primary leading-tight">
                    <?= esc($whyChoose[0]->title) ?>
                    <div class="w-full flex items-center gap-3 mt-3">

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

                <!-- Description -->
                <p class="text-textbody-light leading-relaxed text-justify text-lg">
                    <?= nl2br(esc($whyChoose[0]->short_desc)) ?>
                </p>

            </div>
        <?php endif; ?>

    </div>
</section>

<style>
    @keyframes fade-in-down {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-down {
        animation: fade-in-down .9s ease-out both;
    }
</style>

<section class="py-20 bg-graylight relative overflow-hidden fade-in-section">

    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5 pointer-events-none">
        <div class="absolute top-0 left-0 w-32 h-32 bg-primary rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute top-1/4 right-0 w-24 h-24 bg-secondary rounded-full translate-x-1/2"></div>
        <div class="absolute bottom-0 left-1/4 w-20 h-20 bg-primary rounded-full -translate-y-1/2"></div>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php if (!empty($counters)): ?>
            <?php foreach ($counters as $index => $counter): ?>
                <div class="flex items-center space-x-5 p-5 bg-white/5 backdrop-blur-md rounded-xl 
                            transform transition-all duration-500 hover:scale-105 fade-slide-up <?= $index > 0 ? 'delay-' . ($index * 100) : '' ?>">

                    <div class="w-28 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                        <i class="<?= esc($counter->icon) ?> text-3xl text-primary"></i>
                    </div>

                    <div>
                        <h2 class="text-4xl font-extrabold"><?= esc($counter->count) ?>+</h2>
                        <p class="text-sm uppercase tracking-wide opacity-90"><?= esc($counter->title) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</section>

<!-- LEADERSHIP TEAM - DYNAMIC -->
<section class="relative py-10 overflow-hidden"> 
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="inline-flex items-center bg-secondary/10 border border-secondary/20 gap-2 px-5 py-2 backdrop-blur-sm rounded-full shadow-sm mb-6">
                <span class="text-sm font-semibold text-secondary tracking-wide">MEET OUR LEADERS</span>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <h1 class="text-3xl md:text-4xl font-bold text-primary mb-6 leading-tight">
                    Our Leadership Team
                    <div class="w-full flex items-center justify-center gap-3 mt-3">

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
                </h1>
            </div>
        </div>

        <!-- Leadership Cards -->
        <div class="space-y-10">
            <?php if (!empty($leaders)): ?>
                <?php foreach ($leaders as $index => $leader): ?>
                    <div class="grid lg:grid-cols-3 gap-8 items-start <?= $index % 2 !== 0 ? 'lg:flex-row-reverse' : '' ?>">
                        
                        <!-- Profile Image -->
                        <div class="relative group">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl">
                                <img src="<?= base_url('assets/img/team/' . ($leader->profile_image ?? 'default.png')) ?>" 
                                     alt="<?= esc($leader->full_name) ?>" 
                                     class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/20 to-transparent"></div>
                            </div>

                            <div class="absolute -top-4 -right-4 bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-full shadow-lg">
                                <?= esc($leader->designation) ?>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="lg:col-span-2">
                            <div class="mb-6">
                                <h3 class="text-3xl font-bold text-gray-900 mb-2"><?= esc($leader->full_name) ?></h3>
                                <p class="text-lg text-secondary font-medium mb-4"><?= esc($leader->heading) ?></p>
                            </div>

                            <p class="text-gray-600 text-justify"><?= nl2br(esc($leader->short_description)) ?></p>

                            <?php if (!empty($leader->responsibility)): ?>
                                <div class="bg-gray-50 rounded-xl p-6 mb-6 mt-2">
                                    <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                        <span class="w-6 h-6 bg-primary rounded-full flex items-center justify-center">
                                            <span class="text-white text-xs">✓</span>
                                        </span>
                                        She leads:
                                    </h4>
                                    <div class="grid md:grid-cols-2 gap-3">
                                        <?php
                                        // If responsibility is JSON, decode; otherwise, split by newline
                                        $responsibilities = json_decode($leader->responsibility, true);
                                        if (!is_array($responsibilities)) {
                                            $responsibilities = explode("\n", $leader->responsibility);
                                        }
                                        ?>
                                        <?php foreach ($responsibilities as $resp): ?>
                                            <?php if(trim($resp) !== ''): ?>
                                                <div class="flex items-start gap-2">
                                                    <span class="text-primary">▸</span>
                                                    <span class="text-gray-700"><?= esc($resp) ?></span>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($leader->quote)): ?>
                                <blockquote class="border-l-4 border-secondary pl-6 py-2 my-6">
                                    <p class="text-xl text-gray-700 italic">"<?= esc($leader->quote) ?>"</p>
                                </blockquote>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-gray-500">No leaders found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- ============================== -->
<!--        CTA SECTION (LIGHT)     -->
<!-- ============================== -->
<section class="relative py-20 bg-gray-50 overflow-hidden fade-in-section">

    <!-- Decorative Circles -->
    <div class="absolute inset-0">
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-secondary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 text-center">

        <!-- CTA Heading -->
        <h2 class="text-3xl md:text-4xl font-bold mb-6 leading-snug text-primary animate-fade-up">
            Ready to Start Your Aviation Journey?
        </h2>

        <p class="max-w-2xl mx-auto text-lg text-gray-700 mb-10 animate-fade-up delay-200">
            Join FlyVista Aviation Training Institute and take the first step toward a rewarding career
            in aviation, hospitality, and customer experience.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-6 animate-fade-up delay-300">

            <!-- Enroll Now Button -->
            <a href="<?= base_url('contact') ?>"
                class="bg-primary text-white px-10 py-4 rounded-full font-semibold text-lg shadow-lg
                      hover:bg-primary-dark transition-all duration-300">
                Enroll Now
            </a>

            <!-- Explore Courses Button -->
            <a href="<?= base_url('courses') ?>"
                class="px-10 py-4 rounded-full font-semibold text-lg border-2 border-primary text-primary
                      hover:bg-primary hover:text-white transition-all duration-300">
                Explore Courses
            </a>
        </div>
    </div>
</section>

<!-- Animation -->
<style>
    @keyframes fade-up {
        from {
            opacity: 0;
            transform: translateY(25px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-up {
        animation: fade-up 0.9s ease-out forwards;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }
</style>

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