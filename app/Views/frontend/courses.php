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

<section class="py-10 bg-white relative overflow-hidden fade-in-section">
    <div class="container mx-auto px-6">

        <!-- Section Title -->
        <div class="text-center mb-20">
            <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                <?= esc($sectionTitle->subheading ?? 'Our Courses') ?>
            </span>

            <h2 class="text-3xl lg:text-4xl font-bold text-primary mt-3 mb-[4rem]">
                <?= esc($sectionTitle->heading ?? 'Empowering Aviation Careers with FlyVista') ?>

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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mt-12 sm:mt-12">

            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $i => $course): ?>
                    <div class="group relative bg-white border-gray-300 mt-12 sm:mt-12 lg:mt-16 border-2 rounded-2xl pt-24 pb-16 px-6 shadow-lg hover:shadow-2xl transition-all duration-500 hover:bg-gradient-to-r hover:from-[#335B95] hover:to-[#142947] overflow-visible text-left">

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

                            <!-- Category/Subheading -->
                            <p class="text-sm text-gray-500 uppercase tracking-wide group-hover:text-white transition-all duration-500">
                                <?= esc($course->subheading ?: $course->category) ?>
                            </p>

                            <h3 class="text-xl font-bold text-primary group-hover:text-white mt-1 transition-all duration-500">
                                <?= esc($course->title) ?>
                            </h3>

                            <p class="text-gray-600 text-sm mt-2 group-hover:text-white transition-all duration-500 text-justify">
                                <?= esc($course->short_description) ?>
                            </p>

                            <!-- EXTRA DETAILS (DYNAMIC NOW) -->
                            <div class="mt-5 space-y-3">

                                <!-- Certified / Duration / Level -->
                                <div class="flex items-center justify-between text-sm">

                                    <span class="flex items-center gap-1 text-gray-600 group-hover:text-white">
                                        <i class="fa-solid fa-layer-group text-secondary text-xs"></i>
                                        <?= esc($course->level ?: 'Not Specified') ?>
                                    </span>
                                    <!-- DYNAMIC DURATION -->
                                    <span class="flex items-center gap-1 text-gray-600 group-hover:text-white">
                                        <i class="fa-solid fa-clock text-secondary text-xs"></i>
                                        <?= esc($course->duration ?: 'N/A') ?>
                                    </span>

                                </div>

                                <!-- Progress Bar -->
                                <div class="space-y-1 mt-3">
                                    <div class="flex justify-between text-xs text-gray-600 group-hover:text-white">
                                        <span>Course Progress</span>
                                        <span><?= esc($course->progress ?: 0) ?>%</span>
                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="h-2 bg-gradient-to-r from-secondary-light to-secondary rounded-full transition-all duration-700"
                                            style="width: <?= esc($course->progress ?: 0) ?>%">
                                        </div>
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

<section class="py-10 bg-gradient-to-b from-graylight to-background-light relative overflow-hidden fade-in-section">
    <!-- Background decorative elements -->
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute top-1/3 -left-40 w-80 h-80 bg-secondary/5 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute bottom-40 right-1/4 w-40 h-40 bg-primary/10 rounded-full blur-2xl opacity-60"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <?php if ($program): ?>

            <!-- Program Header -->
            <div class="text-center mb-16 animate-fade-in-up">

                <div class="uppercase inline-flex items-center gap-2 bg-secondary/10 text-secondary px-6 py-3 border border-secondary/20 rounded-full mb-6 shadow-lg">
                    <span class="font-semibold text-sm tracking-wider">
                        PREMIUM AVIATION PROGRAM
                    </span>
                </div>

                <h2 class="text-3xl md:text-3xl lg:text-4xl font-bold text-primary mb-6">
                    <?= htmlspecialchars($program->title) ?>
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

            <!-- Main Grid -->
            <div class="grid lg:grid-cols-2 gap-12 items-start mb-8">

                <!-- LEFT SIDE -->
                <div class="space-y-12">

                    <!-- Complete Transformation Card -->
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary to-primary-dark rounded-3xl blur opacity-25"></div>
                        <div class="relative bg-white rounded-3xl p-10 shadow-2xl border border-gray-100">

                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-gradient-to-br from-primary/5 to-primary/10 rounded-2xl">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-heading-light">Complete Transformation Journey</h3>
                            </div>

                            <p class="text-textbody-light leading-relaxed text-justify text-md">
                                <?= nl2br(htmlspecialchars($program->overview)) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Training Highlights -->
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-secondary to-secondary-dark rounded-3xl blur opacity-20"></div>
                        <div class="relative bg-white rounded-3xl p-10 shadow-2xl border border-gray-100">

                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-gradient-to-br from-secondary/5 to-secondary/10 rounded-2xl">
                                    <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-heading-light">Training Highlights</h3>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <?php
                                $highlights = array_filter(explode("\n", $program->training_highlights));
                                foreach ($highlights as $highlight): ?>
                                    <div class="flex items-start gap-3">
                                        <div class="w-3 h-3 mt-2 bg-gradient-to-r from-secondary to-secondary-light rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-textbody-light text-md"><?= htmlspecialchars($highlight) ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE -->
                <div class="space-y-8">

                    <!-- Image Box -->
                    <div class="group relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-primary to-secondary rounded-3xl blur-xl opacity-20"></div>

                        <div class="relative overflow-hidden rounded-3xl shadow-2xl">

                            <img src="<?= base_url('assets/img/courses/' . htmlspecialchars($program->image)) ?>"
                                alt="<?= htmlspecialchars($program->title) ?>"
                                class="w-full h-full object-cover">

                            <div class="absolute inset-0 bg-gradient-to-t from-heading-light/60 via-transparent"></div>

                            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-8 h-1 bg-secondary rounded-full"></div>
                                    <span class="text-sm font-semibold tracking-wider">
                                        FLAGSHIP PROGRAM
                                    </span>
                                </div>

                                <h4 class="text-2xl font-bold">
                                    <?= htmlspecialchars($program->tagline) ?>
                                </h4>
                            </div>

                        </div>
                    </div>

                    <!-- Distinctive Features -->
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-primary rounded-3xl blur opacity-30"></div>

                        <div class="relative bg-gradient-primary text-white rounded-3xl p-10 shadow-2xl">

                            <div class="flex items-center gap-4 mb-8">
                                <div class="p-3 bg-white/10 rounded-2xl">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold">What Makes This Program Distinctive?</h3>
                            </div>

                            <ul class="space-y-4">
                                <?php
                                $features = array_filter(explode("\n", $program->distinctive_features));
                                foreach ($features as $feature): ?>
                                    <li class="flex items-start gap-4">
                                        <div class="w-3 h-3 mt-2 bg-white/20 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-white/90 text-justify"><?= htmlspecialchars($feature) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>
                    </div>

                    <!-- Outcome -->
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-light to-primary-dark rounded-3xl blur opacity-20"></div>

                        <div class="relative bg-white rounded-3xl p-10 shadow-2xl border border-gray-100">

                            <div class="flex items-center gap-4 mb-4">
                                <div class="p-3 bg-gradient-to-br from-primary/5 to-primary/10 rounded-2xl">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-heading-light">Program Outcome</h3>
                            </div>

                            <div class="relative mb-4">
                                <div class="absolute -left-4 top-0 bottom-0 w-1 bg-gradient-to-b from-primary to-secondary rounded-full"></div>

                                <p class="text-textbody-light text-md leading-relaxed pl-6 text-justify">
                                    <?= nl2br(htmlspecialchars($program->outcome_description)) ?>
                                </p>
                            </div>

                            <div class="pt-2 border-t-2 border-gray-200">
                                <div class="flex items-center justify-between">
                                    <span class="text-textbody-light">Success Rate</span>
                                    <span class="text-3xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                                        <?= htmlspecialchars($program->success_rate) ?>%
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        <?php endif; ?>

    </div>

    <style>
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }
    </style>
</section>

<!-- Student Success Stories Section -->
<section class="py-10 bg-gradient-to-br from-white to-gray-100 relative overflow-hidden fade-in-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <span class="uppercase inline-block px-6 py-2 bg-secondary/10 text-secondary rounded-full font-semibold text-sm tracking-wider border border-secondary/20 mb-4">
                Case Stories
            </span>

            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">
                Real Success Stories from Our Aviation Graduates
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

            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Each student at Flyvista begins with a dream and graduates with a career.
                These case stories highlight real journeys how students overcame challenges,
                enhanced their skills, and secured reputable positions in the aviation industry
                through structured training, mentorship, and hands-on exposure at Flyvista.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- FEATURED STORY CONTAINER (JS will replace content here) -->
            <div id="featuredContainer"></div>

            <!-- OTHER STORIES (Right side) -->
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
                                $parts = explode(" ", $story->name);
                                echo strtoupper(substr($parts[0], 0, 1) . ($parts[1] ?? '')[0]);
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

        <!-- JavaScript -->
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                const featuredContainer = document.getElementById("featuredContainer");
                const otherStories = document.getElementById("otherStories");

                let allStories = [];

                // Collect stories from HTML
                document.querySelectorAll(".story-card").forEach(card => {
                    allStories.push({
                        id: card.dataset.id,
                        name: card.dataset.name,
                        role: card.dataset.role,
                        quote: card.dataset.quote.replace(/\n/g, "<br>"),
                        course: card.dataset.course,
                        image: card.dataset.image,
                        linkedin: card.dataset.linkedin,
                    });
                });

                // First story is featured initially
                let activeStory = allStories[0];

                // ---- Featured Renderer ----
                function renderFeatured(story) {
                    featuredContainer.innerHTML = `
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-500 hover:shadow-2xl">
                            <div class="relative h-80 overflow-hidden">
                                <img src="${story.image}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                            </div>

                            <div class="p-8">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                        ${story.name.split(" ").map(n => n[0]).join("").substring(0,2).toUpperCase()}
                                    </div>

                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">${story.name}</h3>
                                        <p class="text-secondary font-medium">${story.role}</p>
                                    </div>
                                </div>

                                <p class="text-gray-600 mb-6 leading-relaxed text-justify">${story.quote}</p>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                                        <i class="fas fa-graduation-cap text-[#20406C]"></i>
                                        <span>${story.course}</span>
                                    </div>

                                    ${story.linkedin ? `
                                        <a href="${story.linkedin}" target="_blank"
                                            class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-[#20406C] hover:text-white transition-colors">
                                            <i class="fab fa-linkedin-in text-xs"></i>
                                        </a>` : ""}
                                </div>
                            </div>
                        </div>
                    `;
                }

                // ---- Right column renderer ----
                function renderOtherStories() {
                    otherStories.innerHTML = "";

                    allStories.forEach(story => {
                        if (story.id == activeStory.id) return;

                        const card = document.createElement("div");
                        card.className = "story-card bg-white rounded-xl shadow-lg p-6 cursor-pointer";
                        card.dataset.id = story.id;

                        const initials = story.name.split(" ").map(n => n[0]).join("").substring(0, 2).toUpperCase();

                        card.innerHTML = `
                            <div class="flex items-start">
                                <div class="w-16 h-16 bg-[#20406C] rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                                    ${initials}
                                </div>

                                <div class="flex-1">
                                    <h4 class="text-lg font-semibold text-gray-900">${story.name}</h4>
                                    <p class="text-secondary text-sm font-medium mb-2">${story.role}</p>
                                    <p class="text-gray-600 text-sm line-clamp-2">${story.quote}</p>
                                    <div class="flex items-center mt-3 text-xs text-gray-500">
                                        <i class="fas fa-graduation-cap text-[#20406C] mr-1"></i>
                                        <span>${story.course}</span>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Click Event
                        card.addEventListener("click", () => {
                            activeStory = story;
                            renderFeatured(activeStory);
                            renderOtherStories();
                        });

                        otherStories.appendChild(card);
                    });
                }

                // INITIAL RENDER
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
        display: box;
        /* optional fallback for older non-webkit browsers */
        -webkit-line-clamp: 2;
        line-clamp: 2;
        /* standard property */
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