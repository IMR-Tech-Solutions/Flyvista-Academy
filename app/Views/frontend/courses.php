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
<section class="relative w-full h-48 md:h-[22rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) && file_exists(FCPATH . $breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Courses' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Courses' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<section class="py-10 mb bg-white relative overflow-hidden fade-in-section">
    <div class="container mx-auto px-6">
        
        <!-- Section Title -->
        <div class="text-center mb-20">
            <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                <?= esc($sectionTitle->subheading ?? 'Our Courses') ?>
            </span>

            <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-3 mb-[8rem]">
                <?= ($sectionTitle->heading ?? 'Empowering Aviation Careers with FlyVista') ?>

                <div class="w-full flex items-center justify-center mt-2 gap-3">
                    <div class="w-16 h-[2px] bg-gradient-to-r from-transparent to-primary"></div>
                    <span class="h-1 w-1 bg-primary rounded-full"></span>
                    <span class="h-3 w-3 border-2 border-primary rounded-full flex items-center justify-center">
                        <span class="h-1 w-1 bg-primary rounded-full"></span>
                    </span>
                    <span class="h-1 w-1 bg-primary rounded-full"></span>
                    <div class="w-16 h-[2px] bg-gradient-to-l from-transparent to-primary"></div>
                </div>
            </h2>
        </div>

        <!-- Course Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mt-8 sm:mt-12">

            <?php 
            $durations = ['3 Months', '6 Months', '12 Months', '18 Months', '4 Weeks', '8 Weeks'];
            $levels = ['Beginner', 'Intermediate', 'Advanced', 'Professional'];
            ?>

            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $i => $course): ?>
                    <div class="group relative bg-white border-gray-300 mt-12 sm:mt-12 border-2 rounded-2xl pt-24 pb-16 px-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:bg-gradient-to-r hover:from-[#335B95] hover:to-[#142947] overflow-visible text-left">

                        <!-- Course Image -->
                        <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 w-[90%] rounded-xl overflow-hidden shadow-lg">
                            <img src="<?= base_url('assets/img/courses/' . $course->image) ?>" 
                                 alt="<?= esc($course->title) ?>" 
                                 class="w-full h-48 object-cover rounded-xl transition-transform duration-500 group-hover:scale-105">
                        </div>

                        <!-- Icon -->
                        <div class="absolute -top-18 right-6 bg-white text-primary rounded-full p-4 shadow-md transition-all duration-500">
                            <i class="<?= esc($course->icon) ?> text-xl"></i>
                        </div>

                        <!-- Text Content -->
                        <div class="mt-[4rem]">

                            <span class="block w-12 h-[2px] bg-gray-300 group-hover:bg-white transition-all duration-500 mb-3"></span>

                            <p class="text-sm text-gray-500 uppercase tracking-wide group-hover:text-white transition-all duration-500">
                                <?= esc($course->subheading ?: 'Course') ?>
                            </p>

                            <h3 class="text-xl font-bold text-primary group-hover:text-white mt-1 transition-all duration-500">
                                <?= esc($course->title) ?>
                            </h3>

                            <p class="text-gray-600 text-sm mt-2 group-hover:text-white transition-all duration-500">
                                <?= esc($course->short_description) ?>
                            </p>

                            <!-- EXTRA DETAILS SECTION -->
                            <div class="mt-5 space-y-3">

                                <!-- Certified / Duration / Level -->
                                <div class="flex items-center justify-between text-sm">

                                    <span class="flex items-center gap-1 text-gray-600 group-hover:text-white">
                                        <i class="fa-solid fa-certificate text-secondary text-xs"></i>
                                        Certified
                                    </span>

                                    <span class="flex items-center gap-1 text-gray-600 group-hover:text-white">
                                        <i class="fa-solid fa-clock text-secondary text-xs"></i>
                                        <?= $durations[$i % count($durations)] ?>
                                    </span>

                                </div>

                                <!-- Progress Bar -->
                                <div class="space-y-1 mt-3">
                                    <div class="flex justify-between text-xs text-gray-600 group-hover:text-white">
                                        <span>Course Progress</span>
                                        <span>65%</span>
                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="h-2 w-[45%] group-hover:w-[65%] bg-gradient-to-r from-secondary-light to-secondary rounded-full transition-all duration-700"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Arrow Button -->
                        <div class="absolute bottom-[-24px] left-1/2 transform -translate-x-1/2">
                            <a href="<?= base_url('courses/' . $course->slug) ?>"
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-white text-primary shadow-md hover:scale-110 transition-all duration-500 group-hover:text-secondary">
                                <i class="fa-solid fa-arrow-right text-lg"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p class="text-center text-gray-500 col-span-4">No courses available at the moment.</p>
            <?php endif; ?>

        </div>
    </div>
</section>

<!-- Animations -->
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
</style>

<!-- Student Success Stories Section -->
<section class="py-10 bg-gradient-to-br from-white to-gray-100 relative overflow-hidden fade-in-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                Success Stories
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">
                Our Students Soaring High
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
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Discover how FlyVista has transformed dreams into reality.
                Our graduates are making their mark in the aviation industry worldwide.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Featured Story (Image remains fixed) -->
            <div class="relative">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                    <div class="relative h-80 overflow-hidden">
                        <img
                            src="<?= base_url('assets/img/courses/' . $featuredStory->image) ?>"
                            alt="<?= esc($featuredStory->name) ?>"
                            class="w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                            id="featuredImage">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                        <?php if ($featuredStory->is_featured): ?>
                            <div class="absolute bottom-4 left-6">
                                <span class="inline-block px-3 py-1 bg-secondary-light text-white text-sm font-medium rounded-full">
                                    Featured Graduate
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="p-8">
                        <div class="flex items-center mb-4">
                            <div id="featuredInitials" class="w-12 h-12 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                <?php
                                $names = explode(' ', $featuredStory->name);
                                echo strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                                ?>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900" id="featuredName"><?= esc($featuredStory->name) ?></h3>
                                <p class="text-secondary font-medium" id="featuredRole"><?= esc($featuredStory->role) ?></p>
                            </div>
                        </div>

                        <p class="text-gray-600 mb-6 leading-relaxed" id="featuredQuote"><?= esc($featuredStory->quote) ?></p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <i class="fas fa-graduation-cap text-[#20406C]"></i>
                                <span id="featuredCourse"><?= esc($featuredStory->course) ?></span>
                            </div>
                            <?php if (!empty($featuredStory->linkedin_url)): ?>
                                <div class="flex space-x-2">
                                    <a href="<?= esc($featuredStory->linkedin_url) ?>" target="_blank" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#20406C] hover:text-white transition-colors">
                                        <i class="fab fa-linkedin-in text-xs"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Stories -->
            <div id="otherStories" class="space-y-8">
                <?php foreach ($allStories as $story): ?>
                    <div class="story-card bg-white rounded-xl shadow-lg p-6 cursor-pointer"
                        data-id="<?= $story->id ?>"
                        data-name="<?= esc($story->name) ?>"
                        data-role="<?= esc($story->role) ?>"
                        data-quote="<?= esc($story->quote) ?>"
                        data-course="<?= esc($story->course) ?>"
                        data-image="<?= base_url('assets/img/courses/' . $story->image) ?>"
                        data-linkedin="<?= esc($story->linkedin_url) ?>">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-16 h-16 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                <?php
                                $names = explode(' ', $story->name);
                                echo strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                                ?>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-semibold text-gray-900"><?= esc($story->name) ?></h4>
                                <p class="text-secondary text-sm font-medium mb-2"><?= esc($story->role) ?></p>
                                <p class="text-gray-600 text-sm line-clamp-2"><?= esc($story->quote) ?></p>
                                <div class="flex items-center mt-3 text-xs text-gray-500">
                                    <i class="fas fa-graduation-cap text-[#20406C] mr-1"></i>
                                    <span><?= esc($story->course) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const featuredName = document.getElementById('featuredName');
                const featuredRole = document.getElementById('featuredRole');
                const featuredQuote = document.getElementById('featuredQuote');
                const featuredCourse = document.getElementById('featuredCourse');
                const featuredInitials = document.getElementById('featuredInitials');
                const featuredImage = document.getElementById('featuredImage'); // <-- add this

                document.querySelectorAll('.story-card').forEach(card => {
                    card.addEventListener('click', function() {
                        featuredName.textContent = this.getAttribute('data-name');
                        featuredRole.textContent = this.getAttribute('data-role');
                        featuredQuote.textContent = this.getAttribute('data-quote');
                        featuredCourse.textContent = this.getAttribute('data-course');
                        featuredInitials.textContent = this.getAttribute('data-initials');

                        // Update featured image
                        const newImage = this.getAttribute('data-image');
                        if (newImage) {
                            // Optional: smooth fade
                            featuredImage.style.opacity = 0;
                            setTimeout(() => {
                                featuredImage.src = newImage;
                                featuredImage.style.opacity = 1;
                            }, 200);
                        }

                        // Update LinkedIn button
                        const linkedin = this.getAttribute('data-linkedin');
                        let linkedinBtn = featuredInitials.closest('.p-8').querySelector('a');
                        if (linkedin) {
                            if (!linkedinBtn) {
                                linkedinBtn = document.createElement('a');
                                linkedinBtn.className = "w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#20406C] hover:text-white transition-colors";
                                linkedinBtn.innerHTML = '<i class="fab fa-linkedin-in text-xs"></i>';
                                featuredInitials.closest('.p-8').querySelector('div.flex.items-center.justify-between').appendChild(linkedinBtn);
                            }
                            linkedinBtn.href = linkedin;
                            linkedinBtn.style.display = 'flex';
                        } else if (linkedinBtn) {
                            linkedinBtn.style.display = 'none';
                        }

                        // Highlight selected story
                        document.querySelectorAll('.story-card').forEach(c => c.classList.remove('border-2', 'border-[#D4A85D]'));
                        this.classList.add('border-2', 'border-[#D4A85D]');
                    });
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const featuredContainer = document.getElementById('featuredContainer');
                const otherStories = document.getElementById('otherStories');

                let allStories = [];

                // Gather all stories from HTML
                document.querySelectorAll('.story-card').forEach(card => {
                    allStories.push({
                        id: card.getAttribute('data-id'),
                        name: card.getAttribute('data-name'),
                        role: card.getAttribute('data-role'),
                        quote: card.getAttribute('data-quote'),
                        course: card.getAttribute('data-course'),
                        image: card.getAttribute('data-image'),
                        linkedin: card.getAttribute('data-linkedin')
                    });
                });

                // Initialize featured story as first in the array
                let activeStory = allStories[0];

                // Function to render featured story
                function renderFeatured(story) {
                    featuredContainer.innerHTML = `
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                <div class="relative h-80 overflow-hidden">
                    <img src="${story.image}" alt="${story.name}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105" id="featuredImage">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
                <div class="p-8">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                            ${story.name.split(' ').map(n=>n[0]).join('').substring(0,2).toUpperCase()}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">${story.name}</h3>
                            <p class="text-[#D4A85D] font-medium">${story.role}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-6 leading-relaxed">${story.quote}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-graduation-cap text-[#20406C]"></i>
                            <span>${story.course}</span>
                        </div>
                        ${story.linkedin ? `<a href="${story.linkedin}" target="_blank" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#20406C] hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in text-xs"></i>
                        </a>` : ''}
                    </div>
                </div>
            </div>
        `;
                }

                // Function to render right column (other stories)
                function renderOtherStories() {
                    otherStories.innerHTML = '';
                    allStories.forEach(story => {
                        if (story.id == activeStory.id) return; // skip active story
                        const card = document.createElement('div');
                        card.className = "story-card bg-white rounded-xl shadow-lg p-6 cursor-pointer";
                        card.setAttribute('data-id', story.id);
                        card.setAttribute('data-name', story.name);
                        card.setAttribute('data-role', story.role);
                        card.setAttribute('data-quote', story.quote);
                        card.setAttribute('data-course', story.course);
                        card.setAttribute('data-image', story.image);
                        card.setAttribute('data-linkedin', story.linkedin);

                        const initials = story.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();

                        card.innerHTML = `
                <div class="flex items-start">
                    <div class="flex-shrink-0 w-16 h-16 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        ${initials}
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-semibold text-gray-900">${story.name}</h4>
                        <p class="text-[#D4A85D] text-sm font-medium mb-2">${story.role}</p>
                        <p class="text-gray-600 text-sm line-clamp-2">${story.quote}</p>
                        <div class="flex items-center mt-3 text-xs text-gray-500">
                            <i class="fas fa-graduation-cap text-[#20406C] mr-1"></i>
                            <span>${story.course}</span>
                        </div>
                    </div>
                </div>
            `;

                        card.addEventListener('click', () => {
                            activeStory = story;
                            renderFeatured(activeStory);
                            renderOtherStories();
                        });

                        otherStories.appendChild(card);
                    });
                }

                // Initial render
                renderFeatured(activeStory);
                renderOtherStories();
            });
        </script>

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.counter');

        const animateCounter = (counter) => {
            let targetStr = counter.getAttribute('data-target');
            let isPercent = targetStr.includes('%');
            let isPlus = targetStr.includes('+');

            // Remove non-digit characters for counting
            let target = parseInt(targetStr.replace(/[^\d]/g, ''));

            let duration = 2000; // 2 seconds
            let start = 0;
            const step = target / (duration / 16); // approx 60fps

            const formatNumber = (num) => {
                return num.toLocaleString() + (isPercent ? '%' : '') + (isPlus ? '+' : '');
            }

            const updateCounter = () => {
                start += step;
                if (start < target) {
                    counter.innerText = formatNumber(Math.ceil(start));
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = formatNumber(target);
                }
            };
            updateCounter();
        };

        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => observer.observe(counter));
    });
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .story-card {
        transition: all 0.3s ease;
    }

    #featuredImage {
        transition: opacity 0.5s ease, transform 0.7s ease;
    }
</style>


<!-- ============================== -->
<!--        CTA SECTION (LIGHT)     -->
<!-- ============================== -->
<section class="relative py-20 bg-white overflow-hidden">

    <!-- Decorative Circles -->
    <div class="absolute inset-0">
        <div class="absolute -top-20 -left-20 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-secondary/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 text-center">

        <!-- CTA Heading -->
        <h2 class="text-3xl md:text-4xl font-bold mb-6 leading-snug text-primary animate-fade-up">
            Take Off Toward Your Dream Aviation Career
        </h2>

        <p class="max-w-2xl mx-auto text-lg text-gray-700 mb-10 animate-fade-up delay-200">
            Join FlyVista Aviation Training Institute and unlock world-class training, global opportunities, and career-ready skills for the aviation & hospitality industry.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-6 animate-fade-up delay-300">

            <!-- Enroll Now Button -->
            <a href="<?= base_url('contact') ?>"
                class="bg-primary text-white px-10 py-4 rounded-full font-semibold text-lg shadow-lg
                      hover:bg-primary-dark transition-all duration-300">
                Enroll Now
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