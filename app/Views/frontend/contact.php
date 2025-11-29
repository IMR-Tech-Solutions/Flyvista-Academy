<?= $this->extend('frontend/layout/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb Hero Section -->
<section
    class="relative w-full h-48 md:h-[22rem] bg-cover bg-center flex items-center fade-in-section"
    style="background-image: url('<?= isset($breadcrumb->bg_image) ? base_url($breadcrumb->bg_image) : base_url('assets/img/default-bg.jpg') ?>');">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Content -->
    <div class="relative z-10 w-full px-6 md:px-12 flex justify-between items-center">

        <!-- Left: Page Title -->
        <h1 class="text-white text-3xl md:text-4xl font-semibold animate-fade-in-down">
            <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'Contact Us' ?>
        </h1>

        <!-- Right: Breadcrumb -->
        <nav class="text-white flex items-center space-x-2 animate-slide-in-right">
            <a href="<?= base_url('/') ?>" class="hover:text-secondary transition-colors">Home</a>
            <span class="text-white">➤</span>
            <span class="text-white font-bold relative pb-1">
                <?= isset($breadcrumb->heading) ? esc($breadcrumb->heading) : 'contact' ?>
                <span class="absolute left-0 bottom-0 w-full border-b-2 border border-secondary-light opacity-70"></span>
            </span>
        </nav>
    </div>
</section>

<!-- Main Content -->
<style>
    .contact-card {
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .contact-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .form-input {
        transition: all 0.3s ease;
        border: 2px solid #E5E7EB;
    }

    .form-input:focus {
        border-color: #335B95;
        box-shadow: 0 0 0 3px rgba(51, 91, 149, 0.1);
    }

    .faq-item {
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        transform: translateX(5px);
    }

    .gradient-border {
        position: relative;
        background: linear-gradient(135deg, #335B95 0%, #293f5eff 100%);
        padding: 2px;
        border-radius: 16px;
    }

    .gradient-border>div {
        background: white;
        border-radius: 14px;
    }

    .dark .gradient-border>div {
        background: #0F172A;
    }
</style>

<!-- Contact Section -->
<?php $c = isset($contact) ? $contact : null; ?>

<section class="py-10 bg-gradient-to-br from-graylight to-gray-100 dark:from-background-dark dark:to-primary-dark">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-primary dark:text-heading-dark animate-fade-in-down">Get In Touch
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
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-textbody-light dark:text-textbody-dark">
                Have questions about our aviation programs? Reach out to us and we'll help you take flight in your career.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Contact Information -->
            <div class="lg:col-span-1 space-y-8">
                <div class="gradient-border contact-card">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-6 text-primary dark:text-heading-dark flex items-center">
                            <i class="fas fa-headset text-secondary mr-3"></i>
                            Contact Information
                        </h2>

                        <div class="space-y-6">
                            <!-- Location -->
                            <?php if (!empty($c->location)): ?>
                                <div class="flex items-start space-x-4 group">
                                    <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center text-white group-hover:bg-secondary transition-colors duration-300">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg">Our Location</h3>
                                        <p class="text-textbody-light dark:text-textbody-dark"><?= esc($c->location) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Phone -->
                            <?php if (!empty($c->phone)): ?>
                                <div class="flex items-start space-x-4 group">
                                    <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center text-white group-hover:bg-secondary transition-colors duration-300">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg">Phone Number</h3>
                                        <p class="text-textbody-light dark:text-textbody-dark"><?= esc($c->phone) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Email -->
                            <?php if (!empty($c->email)): ?>
                                <div class="flex items-start space-x-4 group">
                                    <div class="w-12 h-12 rounded-lg bg-primary-light flex items-center justify-center text-white group-hover:bg-secondary transition-colors duration-300">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg">Email Address</h3>
                                        <p class="text-textbody-light dark:text-textbody-dark"><?= esc($c->email) ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Social Links -->
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="font-bold text-lg mb-4">Follow Us</h3>
                            <div class="flex space-x-4">
                                <?php if (!empty($c->facebook)): ?>
                                    <a href="<?= esc($c->facebook) ?>" class="w-10 h-10 rounded-lg bg-graylight dark:bg-primary flex items-center justify-center text-primary dark:text-white hover:bg-primary-light hover:text-white transition-colors duration-300">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($c->twitter)): ?>
                                    <a href="<?= esc($c->twitter) ?>" class="w-10 h-10 rounded-lg bg-graylight dark:bg-primary flex items-center justify-center text-primary dark:text-white hover:bg-primary-light hover:text-white transition-colors duration-300">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($c->instagram)): ?>
                                    <a href="<?= esc($c->instagram) ?>" class="w-10 h-10 rounded-lg bg-graylight dark:bg-primary flex items-center justify-center text-primary dark:text-white hover:bg-primary-light hover:text-white transition-colors duration-300">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (!empty($c->linkedin)): ?>
                                    <a href="<?= esc($c->linkedin) ?>" class="w-10 h-10 rounded-lg bg-graylight dark:bg-primary flex items-center justify-center text-primary dark:text-white hover:bg-primary-light hover:text-white transition-colors duration-300">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form & FAQ -->
            <div class="lg:col-span-2">
                <!-- Contact Form -->
                <div class="gradient-border contact-card mb-12">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-2 text-primary dark:text-heading-dark flex items-center">
                            <i class="fas fa-paper-plane text-secondary mr-3"></i>
                            Send Us a Message
                        </h2>
                        <p class="mb-6 text-textbody-light dark:text-textbody-dark">Fill out the form below and we'll get back to you as soon as possible.</p>

                        <?php if (session()->getFlashdata('success')): ?>
                            <p class="bg-green-200 p-3 mb-4 rounded text-sm text-green-800">
                                <?= session()->getFlashdata('success') ?>
                            </p>
                        <?php elseif (session()->getFlashdata('error')): ?>
                            <p class="bg-red-200 p-3 mb-4 rounded text-sm text-red-800">
                                <?= session()->getFlashdata('error') ?>
                            </p>
                        <?php endif; ?>


                        <form id="contact-form" method="post" action="<?= base_url('contact') ?>" class="space-y-6">
                            <?= csrf_field() ?>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 font-medium">Full Name *</label>
                                    <input type="text" name="name" value="<?= old('name') ?>" class="w-full px-4 py-3 rounded-lg form-input" required>
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium">Email Address *</label>
                                    <input type="email" name="email" value="<?= old('email') ?>" class="w-full px-4 py-3 rounded-lg form-input" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block mb-2 font-medium">Phone Number</label>
                                    <input type="tel" name="phone" value="<?= old('phone') ?>" class="w-full px-4 py-3 rounded-lg form-input">
                                </div>

                                <div>
                                    <label class="block mb-2 font-medium">Course Interest</label>
                                    <select name="course" class="w-full px-4 py-3 rounded-lg form-input">
                                        <option value="">Select a course</option>
                                        <?php foreach ($courses_menu as $course): ?>
                                            <option value="<?= esc($course->title) ?>" <?= old('course') == $course->title ? 'selected' : '' ?>>
                                                <?= esc($course->title) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block mb-2 font-medium">Your Message *</label>
                                <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-lg form-input" required><?= old('message') ?></textarea>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="consent" required>
                                <label class="ml-2 text-sm">I agree to the <a href="#" class="text-primary underline">privacy policy</a>.</label>
                            </div>

                            <div class="flex items-center space-x-4">
                                <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-medium">
                                    <i class="fas fa-paper-plane mr-2"></i> Send Message
                                </button>

                                <button type="reset" class="px-6 py-3 bg-gray-200 rounded-lg font-medium">Reset Form</button>
                            </div>
                        </form>

                        <script>
                            // Optional: Client-side validation only, do NOT prevent form submission
                            document.getElementById('contact-form').addEventListener('submit', function(e) {
                                let name = document.getElementById('name').value.trim();
                                let email = document.getElementById('email').value.trim();
                                let message = document.getElementById('message').value.trim();
                                let consent = document.getElementById('consent').checked;

                                if (!name || !email || !message || !consent) {
                                    alert('Please fill all required fields and accept the privacy policy.');
                                    e.preventDefault(); // Prevent only if invalid
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="container mx-auto px-4 py-10">
    <div class="bg-white rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800">
        <div class="grid grid-cols-1 lg:grid-cols-3">
            <!-- Info Panel -->
            <div class="lg:col-span-1 p-8 lg:p-10 bg-white dark:from-primary-dark dark:to-gray-900">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 rounded-xl bg-primary flex items-center justify-center text-white mr-4">
                        <i class="fas fa-map-marked-alt text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl lg:text-3xl font-bold text-primary">Visit Our Campus</h2>
                    </div>
                </div>

                <?php $c = isset($contact) ? $contact : null; ?>

                <!-- Map Info Panel -->
                <div class="space-y-6 mb-8">
                    <!-- Opening Hours -->
                    <?php if (!empty($opening_hours)): ?>
                        <div class="flex items-start space-x-4 p-4 rounded-xl hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-lg bg-secondary/20 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading-light dark:text-heading-dark group-hover:text-primary transition-colors">Opening Hours</h3>
                                <div class="mt-1 space-y-1">
                                    <?php foreach ($opening_hours as $oh): ?>
                                        <p class="text-sm text-textbody-light dark:text-textbody-dark flex justify-between">
                                            <span><?= esc($oh['day']) ?></span>
                                            <span class="font-medium <?= strtolower($oh['time']) === 'closed' ? 'text-red-500' : '' ?>"><?= esc($oh['time']) ?></span>
                                        </p>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Location -->
                    <?php if (!empty($c->location)): ?>
                        <div class="flex items-start space-x-4 p-4 rounded-xl hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 group">
                            <div class="w-10 h-10 rounded-lg bg-secondary/20 flex items-center justify-center text-secondary group-hover:scale-110 transition-transform">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-heading-light dark:text-heading-dark group-hover:text-primary transition-colors">Location</h3>
                                <p class="text-sm text-textbody-light dark:text-textbody-dark mt-1"><?= esc($c->location) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Map Container -->
            <div class="lg:col-span-2 relative">
                <!-- Map -->
                <div class="h-96 lg:h-full w-full">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.755837292896!2d72.8777!3d19.0759837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1620000000000!5m2!1sen!2sin"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        class="filter saturate-110 contrast-110">
                    </iframe>
                </div>

                <!-- Map Overlay Info -->
                <div class="absolute top-4 right-4 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm rounded-xl p-4 shadow-lg max-w-xs">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white flex-shrink-0">
                            <i class="fas fa-plane text-xs"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-sm text-heading-light dark:text-heading-dark">FlyVista Campus</h4>
                            <p class="text-xs text-textbody-light dark:text-textbody-dark mt-1">Located in the heart of Mumbai's aviation district</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="absolute bottom-4 left-4 flex flex-wrap gap-2">
                    <button class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-2 rounded-lg text-xs font-medium text-heading-light dark:text-heading-dark hover:bg-white hover:shadow-md transition-all flex items-center gap-2">
                        <i class="fas fa-car text-primary"></i>
                        Drive
                    </button>
                    <button class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-2 rounded-lg text-xs font-medium text-heading-light dark:text-heading-dark hover:bg-white hover:shadow-md transition-all flex items-center gap-2">
                        <i class="fas fa-subway text-primary"></i>
                        Transit
                    </button>
                    <button class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm px-3 py-2 rounded-lg text-xs font-medium text-heading-light dark:text-heading-dark hover:bg-white hover:shadow-md transition-all flex items-center gap-2">
                        <i class="fas fa-walking text-primary"></i>
                        Walk
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Custom animations for the map section */
    .map-container {
        position: relative;
        overflow: hidden;
    }

    .map-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, #D4A85D, transparent);
        z-index: 10;
    }

    .info-card {
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }

    /* Custom scrollbar for the info panel */
    .info-panel {
        scrollbar-width: thin;
        scrollbar-color: #D4A85D transparent;
    }

    .info-panel::-webkit-scrollbar {
        width: 4px;
    }

    .info-panel::-webkit-scrollbar-track {
        background: transparent;
    }

    .info-panel::-webkit-scrollbar-thumb {
        background-color: #D4A85D;
        border-radius: 20px;
    }
</style>

<script>
    // Add interactivity to the map section
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers for quick action buttons
        const quickActionButtons = document.querySelectorAll('.absolute.bottom-4 button');
        quickActionButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active state from all buttons
                quickActionButtons.forEach(btn => {
                    btn.classList.remove('bg-primary', 'text-white');
                    btn.classList.add('bg-white/95', 'text-heading-light');
                });

                // Add active state to clicked button
                this.classList.remove('bg-white/95', 'text-heading-light');
                this.classList.add('bg-primary', 'text-white');

                // Show loading state
                const originalHTML = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                // Simulate API call
                setTimeout(() => {
                    this.innerHTML = originalHTML;
                    alert(`Directions for ${this.textContent.trim()} mode will be shown in the map`);
                }, 1000);
            });
        });

        // Add hover effect to the map
        const mapIframe = document.querySelector('iframe');
        if (mapIframe) {
            mapIframe.addEventListener('mouseenter', function() {
                this.style.filter = 'saturate(120%) contrast(120%)';
            });

            mapIframe.addEventListener('mouseleave', function() {
                this.style.filter = 'saturate(110%) contrast(110%)';
            });
        }

        // Add scroll animation to info cards
        const infoCards = document.querySelectorAll('.flex.items-start.space-x-4');
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        infoCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = `all 0.5s ease ${index * 0.1}s`;
            observer.observe(card);
        });
    });
</script>

<?= $this->endSection() ?>