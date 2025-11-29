<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>
<style>
    .floating-card {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .gradient-text {
        background: linear-gradient(90deg, #335B95 0%, #142947 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .cta-section {
        background-image: linear-gradient(rgba(32, 64, 108, 0.85), rgba(20, 41, 71, 0.9)), url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHJlY3Qgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIGZpbGw9IiMyMDQwNkMiIGZpbGwtb3BhY2l0eT0iMC4xIi8+PHBhdGggZD0iTTMwIDMwbDE1IDE1TTU1IDQ1bDE1LTE1TTQwIDI1djUwTTYwIDI1djUwTTI1IDQwaDUwTTI1IDYwaDUwIiBzdHJva2U9IiNENEE4NUQiIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIi8+PC9zdmc+');
        background-size: cover;
        background-position: center;
    }
</style>

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

<!-- Breadcrumb -->
<section class="relative w-full h-48 md:h-[22rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) && file_exists(FCPATH . $breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex flex-col md:flex-row justify-center md:justify-between items-center space-y-4 md:space-y-0">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down text-center md:text-left">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : esc($course->name) ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex flex-row flex-wrap items-center space-x-2 animate-slide-in-right justify-center text-center md:text-left">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <a href="<?= base_url('courses') ?>" class="text-white hover:text-secondary transition-colors">Courses</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : esc($course->name) ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<section class="bg-graylight fade-in-section">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="flex flex-col lg:flex-row gap-10">

            <!-- Left Column -->
            <div class="lg:w-8/12">

                <!-- Course Banner -->
                <div class="relative mb-10 rounded-2xl overflow-hidden shadow-xl floating-card">
                    <img src="<?= base_url('assets/img/courses/' . $course->image) ?>"
                        class="w-full h-64 md:h-96 object-cover transition-transform duration-700 hover:scale-105"
                        alt="Course Banner">

                    <div class="absolute inset-0 bg-gradient-to-t from-primary/85 via-primary/40 to-transparent"></div>
                </div>

                <!-- About Section -->
                <section id="about" class="section-fade mb-14 scroll-mt-20">
                    <div class="flex items-center mb-6">
                        <div class="h-8 w-1 bg-secondary rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-primary dark:text-heading-dark">
                            <?= esc($detail->about_title) ?>
                        </h2>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition floating-card">
                        <p class="text-lg leading-relaxed text-textbody-light dark:text-textbody-dark">
                            <?= ($detail->about_description) ?>
                        </p>
                    </div>
                </section>

                <!-- Skills Section -->
                <section id="skills" class="section-fade mb-14 scroll-mt-20">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-1 bg-secondary rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-primary dark:text-heading-dark">Skills You Will Learn</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <?php foreach ($detail->skills as $skill): ?>
                            <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl floating-card group transition border border-transparent hover:border-secondary/20">
                                <div class="flex items-center mb-4">
                                    <div class="w-14 h-14 bg-primary/10 rounded-xl border border-primary flex items-center justify-center mr-4 group-hover:bg-primary/20 transition">
                                        <i class="<?= esc($skill['icon']) ?> text-primary text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-semibold text-primary group-hover:text-secondary transition">
                                        <?= esc($skill['title']) ?>
                                    </h3>
                                </div>
                                <p class="text-textbody-light group-hover:text-primary transition"><?= esc($skill['description']) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Training Methods -->
                <section id="training-methods" class="section-fade mb-14 scroll-mt-20">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-1 bg-secondary rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-primary dark:text-heading-dark">Training Methods</h2>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg floating-card">
                        <div class="space-y-6">
                            <?php foreach ($detail->training_methods as $tm): ?>
                                <div class="flex items-start">
                                    <div class="w-14 h-14 bg-primary rounded-full flex items-center justify-center shadow-md">
                                        <i class="<?= esc($tm['icon']) ?> text-white text-lg"></i>
                                    </div>
                                    <div class="ml-5">
                                        <h4 class="text-xl font-semibold text-primary"><?= esc($tm['title']) ?></h4>
                                        <p class="mt-1 text-textbody-light"><?= esc($tm['description']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>

                <!-- Duration & Eligibility -->
                <section id="duration" class="section-fade mb-14 scroll-mt-20">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-1 bg-secondary rounded-full mr-4"></div>
                        <h2 class="text-3xl font-bold text-primary dark:text-heading-dark">Duration & Eligibility</h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Program Details -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg floating-card">
                            <h3 class="text-xl font-bold text-primary mb-4">Program Details</h3>
                            <div class="space-y-4">
                                <?php
                                $details = [
                                    "Duration" => "6 Months",
                                    "Training Hours" => "480 Hours",
                                    "Batch Size" => "20-25 Students",
                                    "Certification" => "Internationally Recognized"
                                ];
                                foreach ($details as $label => $value): ?>
                                    <div class="flex justify-between border-b pb-3 border-gray-200 dark:border-gray-700">
                                        <span class="font-medium"><?= $label ?></span>
                                        <span><?= $value ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Eligibility -->
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg floating-card">
                            <h3 class="text-xl font-bold text-primary mb-4">Eligibility Criteria</h3>
                            <ul class="space-y-3">
                                <?php foreach ($detail->eligibility as $e): ?>
                                    <li class="flex items-start">
                                        <i class="fa-regular fa-circle-dot text-secondary mt-1 mr-3"></i>
                                        <span><?= esc($e) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </section>

            </div>

            <!-- Right Column -->
            <div class="lg:w-4/12">

                <!-- All Courses -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg floating-card mb-10">
                    <h3 class="text-2xl font-bold text-primary mb-4">Our Courses</h3>
                    <ul class="space-y-3">
                        <?php foreach ($courses as $c): ?>
                            <li class="flex items-center p-4 rounded-xl transition <?= ($c->id == $course->id) ? 'bg-primary text-white shadow-lg' : 'hover:bg-gray-100' ?>">
                                <a href="<?= base_url('courses/' . $c->slug) ?>" class="flex items-center w-full">
                                    <i class="<?= esc($c->icon) ?> <?= ($c->id == $course->id) ? 'text-white' : 'text-primary' ?> mr-3 text-lg"></i>
                                    <span class="font-medium"><?= esc($c->title) ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- CTA + Brochure -->
                <div class="sticky top-28 space-y-8">

                    <!-- CTA -->
                    <div class="cta-section rounded-2xl p-8 text-white text-center shadow-xl floating-card bg-gradient-primary">
                        <h3 class="text-2xl font-extrabold mb-3">Start Your Aviation Journey!</h3>
                        <p class="mb-6 opacity-90 leading-relaxed">Take the first step towards a successful aviation career and join our upcoming batch.</p>

                        <button id="apply-now-btn"
                            class="bg-secondary hover:bg-secondary-light text-white font-bold py-3 px-3 rounded-lg transition transform hover:scale-105 w-1/2"
                            onclick="window.location.href='<?= base_url('admission') ?>'">
                            Apply Now <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>

                    <!-- Brochure -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg floating-card">
                        <h3 class="text-xl font-bold text-primary mb-3">Course Brochure</h3>
                        <p class="mb-4 text-textbody-light leading-relaxed">Download our detailed brochure to explore curriculum, fees, benefits, and more.</p>

                        <button id="download-brochure-btn"
                            class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-4 rounded-lg transition flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i> Download Brochure
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </main>
</section>

<!-- CTA Section -->
<section class="py-10 bg-white relative overflow-hidden fade-in-secion">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-10 left-10 w-20 h-20 bg-primary rounded-full"></div>
        <div class="absolute top-40 right-20 w-16 h-16 bg-secondary rounded-full"></div>
        <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-primary rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-12 h-12 bg-secondary rounded-full"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Left Content -->
            <div class="space-y-8 animate-fade-in-down">
                <!-- Badge -->
                <span class="inline-block px-4 py-2 bg-secondary/10 text-secondary border border-secondary-light font-semibold rounded-full text-sm uppercase tracking-wider">
                    Start Your Journey
                </span>

                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-primary">
                    Ready to Take Flight with Your Career?
                </h2>

                <!-- Description -->
                <p class="text-lg text-gray-600 leading-relaxed">
                    Join thousands of successful aviation professionals who started their journey at FlyVista.
                    Our comprehensive training programs and industry connections will launch your career to new heights.
                </p>

                <!-- Features List -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-secondary-light rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Placement Assistance</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-secondary-light rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Industry Expert Trainers</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-secondary-light rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Modern Training Blog</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-6 h-6 bg-secondary-light rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Global Certification</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - CTA Card -->
            <div class="animate-fade-in-down delay-300">
                <div class="bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-8 shadow-2xl transform hover:scale-105 transition-all duration-500">
                    <div class="text-center mb-8">
                        <!-- Icon -->
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-plane text-white text-3xl"></i>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4">
                            Begin Your Aviation Career Today
                        </h3>
                        <p class="text-white/80">
                            Limited seats available for upcoming batches. Secure your spot now!
                        </p>
                    </div>

                    <!-- CTA Form -->
                    <form id="course-form" method="POST" action="<?= base_url('course-application-submit') ?>">
                        <div class="space-y-4">

                            <div>
                                <input type="text" name="full_name" placeholder="Full Name" required
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white">
                            </div>

                            <div>
                                <input type="email" name="email" placeholder="Email Address" required
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white">
                            </div>

                            <div>
                                <input type="tel" name="phone" placeholder="Phone Number" required
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white">
                            </div>

                            <div>
                                <input type="text" name="subject" placeholder="Subject" required
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white">
                            </div>

                            <div>
                                <select name="course" required
                                    class="w-full px-4 py-3 rounded-lg bg-white/10 border border-white/20 text-white">
                                    <option value="">Select Course</option>
                                    <option value="airhostess">Airhostess Training</option>
                                    <option value="ground-crew">Ground Crew Training</option>
                                    <option value="cabin-management">Cabin Crew Management</option>
                                    <option value="customer-service">Aviation Customer Service</option>
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full bg-secondary-light/80 hover:bg-secondary-dark text-white font-semibold py-4 px-6 rounded-lg">
                                Apply Now
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 text-center">
                    <p class="text-gray-500 text-sm">
                        <i class="fas fa-phone mr-2"></i>
                        Need immediate assistance?
                        <a href="tel:+18001234567" class="text-primary font-semibold hover:text-secondary transition-colors">
                            Call +1 800 123 4567
                        </a>
                    </p>
                </div>
            </div>
        </div>
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
        animation: fade-in-down 0.8s ease-out forwards;
        opacity: 0;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    /* Custom scrollbar for select */
    select option {
        background: white;
        color: #333;
    }

    /* Hover effects */
    .bg-white\/10:hover {
        background-color: rgba(255, 255, 255, 0.15);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('course-form');

        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Stop normal submission

            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;

            // Button loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Processing...';
            submitBtn.disabled = true;

            // Prepare form data
            let formData = new FormData(form);

            // SEND TO BACKEND
            fetch("<?= base_url('course-application-submit') ?>", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(result => {

                    if (result.status === "success") {

                        alert("Thank you! Your application has been received.");

                        form.reset();

                        submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i> Application Sent!';
                        submitBtn.classList.add("bg-green-500");
                        submitBtn.classList.remove("bg-secondary");

                        setTimeout(() => {
                            submitBtn.innerHTML = originalBtnText;
                            submitBtn.disabled = false;
                            submitBtn.classList.remove("bg-green-500");
                            submitBtn.classList.add("bg-secondary");
                        }, 3000);

                    } else {
                        alert("Error: " + JSON.stringify(result.message));
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    alert("Something went wrong!");
                    console.error(error);
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                });

        });

    });
</script>

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