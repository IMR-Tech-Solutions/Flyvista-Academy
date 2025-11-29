<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlyVista – Aviation Training Institute</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;600;700&family=Kumbh+Sans:wght@400;500;600&family=Roboto+Serif:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Roboto Serif"', 'serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#20416C',
                            light: '#253D6B',
                            dark: '#142947'
                        },
                        secondary: {
                            DEFAULT: '#D83030',
                            light: '#E62834',
                            dark: '#B32222'
                        },
                        graylight: '#F4F5FA',
                        textbody: {
                            light: '#333F4D',
                            dark: '#E5E7EB'
                        },
                        heading: {
                            light: '#16243E',
                            dark: '#F9FAFB'
                        },
                        background: {
                            light: '#FFFFFF',
                            dark: '#0F172A'
                        }
                    },
                    backgroundImage: {
                        'gradient-primary': 'linear-gradient(90deg, #253D6B 0%, #142947 100%)',
                    }
                },
            },
        }
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #E62834 0%, #B32222 100%);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: #D83030 !important;
        }

        .nav-link.active::after {
            width: 100%;
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.4s ease;
        }

        .mobile-menu.active {
            transform: translateX(0);
        }

        .mobile-menu-overlay {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }
    </style>
    <style>
        /* Dash hidden normally */
        .dropdown-item .dash {
            display: block;
            width: 0;
            height: 2px;
            background-color: #D83030;
            /* secondary */
            transition: width 0.25s ease, opacity 0.25s ease;
            opacity: 0;
            flex-shrink: 0;
        }

        .dropdown-item:hover .dash {
            width: 12px;
            opacity: 1;
        }

        .mobile-dropdown-item .mobile-dash {
            display: block;
            width: 0;
            height: 2px;
            background-color: #D83030;
            /* secondary color */
            transition: width 0.25s ease, opacity 0.25s ease;
            opacity: 0;
            flex-shrink: 0;
        }

        .mobile-dropdown-item:hover .mobile-dash,
        .mobile-dropdown-item:active .mobile-dash {
            width: 12px;
            opacity: 1;
        }

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

        .slide-in-left {
            opacity: 0;
            transform: translateX(-40px);
            transition: all 0.8s ease-out;
        }

        .slide-in-left.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
    </style>

</head>

<body class="bg-white font-sans">

    <!-- TOPBAR -->
    <div class="bg-gradient-to-r from-primary-dark to-primary text-white text-sm relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-20 h-20 bg-secondary rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-secondary rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center h-auto md:h-12 relative z-10 py-2 md:py-0 space-y-2 md:space-y-0">
            <!-- Contact Info -->
            <div class="flex flex-col md:flex-row items-center md:space-x-6 space-y-1 md:space-y-0">
                <!-- Phone -->
                <div class="flex items-center space-x-2 group cursor-pointer">
                    <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-secondary transition-all duration-300">
                        <i class="fa-solid fa-phone text-xs"></i>
                    </div>
                    <div class="text-center md:text-left">
                        <span class="text-white/80 text-xs">Toll-Free</span>
                        <a href="tel:+18001234567" class="font-semibold text-white hover:text-secondary transition-colors duration-200 block text-sm">
                            +1 800 123 4567
                        </a>
                    </div>
                </div>

                <!-- Email -->
                <div class="hidden sm:flex items-center space-x-2 group cursor-pointer">
                    <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-secondary transition-all duration-300">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </div>
                    <div>
                        <span class="text-white/80 text-xs">Email Us</span>
                        <a href="mailto:info@flyvista.com" class="font-semibold text-white hover:text-secondary transition-colors duration-200 block text-sm">
                            info@flyvista.com
                        </a>
                    </div>
                </div>
            </div>

            <!-- Social + WhatsApp -->
            <div class="flex items-center space-x-3">
                <!-- Social Icons -->
                <div class="flex items-center space-x-2 border-r border-white/20 pr-3">
                    <a href="https://www.facebook.com/flyvista" target="_blank"
                        class="w-7 h-7 bg-white/10 rounded-full flex items-center justify-center hover:bg-blue-600 hover:scale-110 transition-all duration-300 group">
                        <i class="fab fa-facebook-f text-xs group-hover:text-white"></i>
                    </a>
                    <a href="https://twitter.com/flyvista" target="_blank"
                        class="w-7 h-7 bg-white/10 rounded-full flex items-center justify-center hover:bg-blue-400 hover:scale-110 transition-all duration-300 group">
                        <i class="fab fa-twitter text-xs group-hover:text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/flyvista" target="_blank"
                        class="w-7 h-7 bg-white/10 rounded-full flex items-center justify-center hover:bg-pink-600 hover:scale-110 transition-all duration-300 group">
                        <i class="fab fa-instagram text-xs group-hover:text-white"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/flyvista" target="_blank"
                        class="w-7 h-7 bg-white/10 rounded-full flex items-center justify-center hover:bg-blue-800 hover:scale-110 transition-all duration-300 group">
                        <i class="fab fa-linkedin-in text-xs group-hover:text-white"></i>
                    </a>
                </div>

                <!-- WhatsApp -->
                <a href="https://wa.me/917019786263?text=Hello%20FlyVista!" target="_blank"
                    class="flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-2 sm:px-3 py-1.5 rounded-full transition-all duration-300 hover:scale-105 hover:shadow-lg group">
                    <div class="w-5 h-5 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fab fa-whatsapp text-xs"></i>
                    </div>
                    <span class="font-medium text-sm hidden sm:inline">Chat with Us</span>
                    <i class="fa-solid fa-arrow-right text-xs transform group-hover:translate-x-0.5 transition-transform duration-300"></i>
                </a>
            </div>
        </div>

        <!-- Animated Border Bottom -->
        <div class="h-0.5 bg-gradient-to-r from-transparent via-secondary to-transparent animate-pulse"></div>
    </div>

    <!-- HEADER -->
    <header id="header" class="sticky top-0 z-50 bg-white shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3 md:py-4">

                <!-- Logo -->
                <a href="<?= base_url('/') ?>" class="flex items-center">
                    <img src="<?= base_url('assets/img/flyvista-logo.png') ?>" class="h-20 w-auto object-contain" alt="FlyVista Logo">
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex space-x-8 text-sm font-medium text-primary">
                    <a href="<?= base_url('/') ?>" class="nav-link py-2">Home</a>
                    <a href="<?= base_url('about') ?>" class="nav-link py-2">About</a>

                    <!-- Courses Dropdown -->
                    <div class="relative dropdown">
                        <button class="w-full flex justify-between items-center py-2 nav-link">
                            Courses <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>

                        <div class="dropdown-menu absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-md border border-gray-100 z-50">

                            <?php foreach ($courses_menu as $item): ?>
                                <a href="<?= base_url('courses/' . $item->slug) ?>"
                                    class="dropdown-item flex items-start gap-2 py-2 px-4 text-primary hover:text-secondary">
                                    <span class="dash mt-2"></span>
                                    <span><?= esc($item->title) ?></span>
                                </a>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <a href="<?= base_url('admission') ?>" class="nav-link py-2">Admission Process</a>
                    <a href="<?= base_url('blog') ?>" class="nav-link py-2">Blog</a>
                    <a href="<?= base_url('contact') ?>" class="nav-link py-2">Contact</a>
                </nav>

                <!-- Contact Info -->
                <div class="hidden lg:flex items-center gap-3">
                    <div class="relative group">
                        <div class="flex items-center justify-center bg-gradient-primary text-xl rounded-full w-12 h-12 text-white shadow-md transition-transform duration-300 group-hover:scale-110">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="animate-fade-in-down">
                        <p class="text-md text-gray-500 leading-tight">Call Us Anytime</p>
                        <a href="tel:+18001234567" class="text-secondary font-semibold hover:text-primary">+1 800 123 4567</a>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="lg:hidden p-2 text-primary">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

            </div>
        </div>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="mobile-menu-overlay fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"></div>

    <!-- MOBILE MENU -->
    <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 w-80 h-full bg-white shadow-xl z-50 lg:hidden overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-8">
                <img src="<?= base_url('assets/img/flyvista-logo.png') ?>" class="h-16 w-auto">
                <button id="mobile-menu-close" class="text-gray-500 hover:text-secondary">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <nav class="space-y-4">
                <a href="<?= base_url('/') ?>" class="mobile-link block py-3 px-4 rounded-lg">Home</a>
                <a href="<?= base_url('about') ?>" class="mobile-link block py-3 px-4 rounded-lg">About</a>

                <!-- Mobile Dropdown -->
                <button id="mobile-courses-toggle"
                    class="w-full flex justify-between items-center py-3 px-4 mobile-link rounded-lg">
                    Courses <i class="fa-solid fa-chevron-down text-xs"></i>
                </button>

                <div id="mobile-courses-menu" class="hidden ml-4">

                    <?php if (!empty($courses_menu)) : ?>
                        <?php foreach ($courses_menu as $course) : ?>
                            <a href="<?= base_url('courses/' . $course->slug) ?>"
                                class="mobile-dropdown-item flex items-start gap-2 py-2 px-4 text-primary">
                                <span class="mobile-dash mt-2"></span>
                                <span><?= esc($course->title) ?></span>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>

                <a href="<?= base_url('admission') ?>" class="mobile-link block py-3 px-4 rounded-lg">Admission Process</a>
                <a href="<?= base_url('blog') ?>" class="mobile-link block py-3 px-4 rounded-lg">Blog</a>
                <a href="<?= base_url('contact') ?>" class="mobile-link block py-3 px-4 rounded-lg">Contact</a>
            </nav>
        </div>
    </div>

    <!-- Active Menu Script -->
    <script>
        const currentURL = "<?= base_url(uri_string()) ?>";

        function setActiveLinks(selector) {
            document.querySelectorAll(selector).forEach(link => {
                const linkURL = link.getAttribute("href");

                if (linkURL === currentURL) {
                    link.classList.add("active", "text-secondary");
                }

                // Highlight dropdown parent if child active
                if (currentURL.includes("courses") && link.textContent.trim() === "Courses") {
                    link.classList.add("active", "text-secondary");
                }
            });
        }

        setActiveLinks(".nav-link");
        setActiveLinks(".mobile-link");
    </script>

    <!-- Main Content -->
    <main class="min-h-[70vh]">
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-[#253D6B] via-[#234578] to-[#142947] text-white py-10 relative overflow-hidden fade-in-section slide-in-left">

        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-20 -right-20 w-60 h-60 rounded-full bg-white/5"></div>
            <div class="absolute -bottom-32 -left-20 w-80 h-80 rounded-full bg-white/5"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full border border-white/10"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- Logo & About -->
                <div class="transform transition-transform duration-500 hover:-translate-y-1">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="relative">
                            <img src="<?= base_url('assets/img/flyvista-logo.png') ?>" alt="FlyVista Logo" class="w-auto h-20">
                        </div>
                    </div>

                    <p class="text-gray-300 mb-6 leading-relaxed text-md">
                        Premier aviation training institute providing world-class education and career opportunities in the aviation industry.
                    </p>

                    <div class="flex space-x-3">
                        <a href="https://www.facebook.com/flyvista" target="_blank"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-gray-300 shadow-md hover:bg-white/20 hover:text-[#D83030] transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="https://twitter.com/flyvista" target="_blank"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-gray-300 shadow-md hover:bg-white/20 hover:text-[#D83030] transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="https://www.instagram.com/flyvista" target="_blank"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-gray-300 shadow-md hover:bg-white/20 hover:text-[#D83030] transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="https://www.linkedin.com/company/flyvista" target="_blank"
                            class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 text-gray-300 shadow-md hover:bg-white/20 hover:text-[#D83030] transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="transform transition-transform duration-500 hover:-translate-y-1">
                    <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                        Quick Links
                        <span class="absolute -bottom-2 left-0 w-10 h-0.5 bg-[#E62834]"></span>
                    </h3>

                    <ul class="space-y-3">
                        <li class="group">
                            <a href="<?= base_url('/') ?>" class="text-gray-300 hover:text-secondary transition-all duration-300 flex items-center">
                                <span class="w-2 h-2 bg-secondary rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>
                                <span class="ml-0 group-hover:ml-3 transition-all duration-300">Home</span>
                            </a>
                        </li>

                        <li class="group">
                            <a href="<?= base_url('about') ?>" class="text-gray-300 hover:text-[#E62834] transition-all duration-300 flex items-center">
                                <span class="w-2 h-2 bg-[#E62834] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>
                                <span class="ml-0 group-hover:ml-3 transition-all duration-300">About Us</span>
                            </a>
                        </li>

                        <li class="group">
                            <a href="<?= base_url('careers') ?>" class="text-gray-300 hover:text-[#E62834] transition-all duration-300 flex items-center">
                                <span class="w-2 h-2 bg-[#E62834] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>
                                <span class="ml-0 group-hover:ml-3 transition-all duration-300">Career Opportunities</span>
                            </a>
                        </li>

                        <li class="group">
                            <a href="<?= base_url('courses') ?>" class="text-gray-300 hover:text-[#E62834] transition-all duration-300 flex items-center">
                                <span class="w-2 h-2 bg-[#E62834] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>
                                <span class="ml-0 group-hover:ml-3 transition-all duration-300">Courses</span>
                            </a>
                        </li>

                        <li class="group">
                            <a href="<?= base_url('contact') ?>" class="text-gray-300 hover:text-[#E62834] transition-all duration-300 flex items-center">
                                <span class="w-2 h-2 bg-[#E62834] rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>
                                <span class="ml-0 group-hover:ml-3 transition-all duration-300">Contact</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Our Courses (Dynamic) -->
                <div class="transform transition-transform duration-500 hover:-translate-y-1">
                    <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                        Our Courses
                        <span class="absolute -bottom-2 left-0 w-10 h-0.5 bg-[#E62834]"></span>
                    </h3>

                    <ul class="space-y-3">
                        <?php if (!empty($courses_menu)) : ?>
                            <?php foreach ($courses_menu as $course) : ?>
                                <li class="group">
                                    <a href="<?= base_url('courses/' . $course->slug) ?>"
                                        class="text-gray-300 hover:text-[#E62834] transition-all duration-300 flex items-center">
                                        <span class="w-2 h-2 bg-[#E62834] rounded-full opacity-0 
                                              group-hover:opacity-100 transition-all duration-300 group-hover:ml-3"></span>

                                        <span class="ml-0 group-hover:ml-3 transition-all duration-300">
                                            <?= esc($course->title) ?>
                                        </span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="transform transition-transform duration-500 hover:-translate-y-1">
                    <h3 class="text-xl font-bold mb-6 text-white relative inline-block">
                        Contact Info
                        <span class="absolute -bottom-2 left-0 w-10 h-0.5 bg-[#E62834]"></span>
                    </h3>

                    <ul class="space-y-5">

                        <li class="flex items-center group">
                            <div class="w-10 md:w-16 h-10 rounded-full bg-white/10 flex items-center justify-center mr-4 group-hover:bg-[#E62834] transition-colors duration-300">
                                <i class="fa-solid fa-location-dot text-white group-hover:text-white text-base leading-none"></i>
                            </div>
                            <span class="text-gray-200 pt-2">
                                123 Aviation Avenue, Airport City, AC 12345
                            </span>
                        </li>

                        <li class="flex items-center group">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-4 group-hover:bg-[#E62834] transition-colors duration-300">
                                <i class="fa-solid fa-phone text-white group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <a href="tel:+18001234567" class="text-gray-300 hover:text-[#E62834] transition-colors pt-2">
                                +1 800 123 4567
                            </a>
                        </li>

                        <li class="flex items-center group">
                            <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center mr-4 group-hover:bg-[#E62834] transition-colors duration-300">
                                <i class="fa-solid fa-envelope text-white group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <a href="mailto:info@flyvista.com" class="text-gray-300 hover:text-[#E62834] transition-colors pt-2">
                                info@flyvista.com
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-white/20 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">

                <p class="text-gray-300 text-sm md:mb-0">
                    &copy; 2025 FlyVista Aviation Training Institute. All rights reserved.
                </p>

                <div class="flex space-x-6 text-sm items-center">
                    <a href="<?= base_url('privacy-policy') ?>" class="text-gray-300 hover:text-[#E62834] transition-colors">
                        Privacy Policy
                    </a>

                    <a href="<?= base_url('terms') ?>" class="text-gray-300 hover:text-[#E62834] transition-colors">
                        Terms of Service
                    </a>

                    <span class="text-gray-300">|</span>
                    <span class="text-gray-300">Designed & Developed by</span>

                    <a href="https://imrtechsolutions.com/"
                        target="_blank" class="text-gray-300 hover:text-[#E62834] transition-colors">
                        IMR Tech Solution
                    </a>
                </div>

            </div>

        </div>
    </footer>
    <button id="backToTopBtn"
        class="fixed bottom-6 right-6 bg-gradient-to-r from-primary-dark via-[#234578] to-primary-light text-white px-4 py-3 rounded-full shadow-lg 
           opacity-0 text-2xl pointer-events-none transition-all duration-300 hover:bg-[#b88d4c] z-[9998]">
        ⮝
    </button>

    <script>
        const backToTopBtn = document.getElementById("backToTopBtn");

        // Show button when page is scrolled down
        window.addEventListener("scroll", () => {
            if (window.scrollY > 200) {
                backToTopBtn.classList.remove("opacity-0", "pointer-events-none");
            } else {
                backToTopBtn.classList.add("opacity-0", "pointer-events-none");
            }
        });

        // Scroll to top smoothly when clicked
        backToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

    <script>
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileCoursesToggle = document.getElementById('mobile-courses-toggle');
        const mobileCoursesMenu = document.getElementById('mobile-courses-menu');

        // open
        mobileMenuToggle.addEventListener('click', () => {
            mobileMenu.classList.add('active');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        });

        // close
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            mobileCoursesMenu.classList.add('hidden');
        }

        mobileMenuClose.addEventListener('click', closeMobileMenu);
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);

        // toggle submenu
        mobileCoursesToggle.addEventListener('click', () => {
            mobileCoursesMenu.classList.toggle('hidden');
            const icon = mobileCoursesToggle.querySelector('i.fa-chevron-down');
            icon.classList.toggle('rotate-180');
        });

        // desktop arrow rotation
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const arrow = dropdown.querySelector('.dropdown-arrow');
            dropdown.addEventListener('mouseenter', () => arrow.classList.add('rotate-180'));
            dropdown.addEventListener('mouseleave', () => arrow.classList.remove('rotate-180'));
        });

        // sticky header
        const header = document.getElementById('header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) header.classList.add('header-scrolled');
            else header.classList.remove('header-scrolled');
        });
    </script>

    <!-- MODERN CHATBOT BUTTON -->
    <div id="chatbot-btn"
        class="fixed bottom-24 right-6 z-[9999] cursor-pointer">

        <!-- Outer Pulse Ring -->
        <div class="absolute inset-0 w-14 h-14 rounded-full animate-ping bg-secondary/40"></div>

        <!-- Button -->
        <div class="relative w-14 h-14 rounded-full 
            bg-gradient-to-br from-secondary to-secondary-dark
            shadow-xl flex items-center justify-center 
            ring-2 ring-white/40 backdrop-blur-md
            hover:scale-110 hover:shadow-2xl transition-all duration-300">

            <i class="fa-solid fa-comment text-white text-2xl"></i>
        </div>
    </div>

    <!-- CHATBOT BOX -->
    <div id="chatbot-box"
        class="fixed bottom-24 right-6 w-80 bg-white shadow-2xl rounded-xl overflow-hidden hidden border border-gray-200 z-[9999]">

        <!-- Header -->
        <div class="bg-gradient-to-r from-primary-dark to-primary-light text-white p-4 flex justify-between items-center">
            <h3 class="font-semibold text-lg">FlyVista Assistant</h3>
            <button id="chatbot-close" class="text-white">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chatbot-messages" class="h-80 p-4 overflow-y-auto space-y-3 bg-gray-50">
            <div class="flex items-start space-x-2">
                <div class="bg-primary text-white px-3 py-2 rounded-lg text-sm">
                    Hi! 👋 I'm FlyVista Assistant.<br>How can I help you today?
                </div>
            </div>
        </div>

        <!-- Input box -->
        <div class="p-3 border-t bg-white flex space-x-2">
            <input id="chatbot-input" type="text" placeholder="Type your message…"
                class="flex-1 px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-secondary">
            <button id="chatbot-send"
                class="bg-secondary text-white px-4 py-2 rounded-lg hover:bg-secondary-dark">
                Send
            </button>
        </div>
    </div>

    <script>
        const chatbotBtn = document.getElementById("chatbot-btn");
        const chatbotBox = document.getElementById("chatbot-box");
        const chatbotClose = document.getElementById("chatbot-close");
        const chatbotMessages = document.getElementById("chatbot-messages");
        const chatbotInput = document.getElementById("chatbot-input");
        const chatbotSend = document.getElementById("chatbot-send");

        chatbotBtn.onclick = () => chatbotBox.classList.toggle("hidden");
        chatbotClose.onclick = () => chatbotBox.classList.add("hidden");

        function addMessage(content, type) {
            const div = document.createElement("div");
            div.className = "flex items-start space-x-2 " + (type === "user" ? "justify-end" : "");

            div.innerHTML =
                type === "user" ?
                `<div class="bg-secondary text-white px-3 py-2 rounded-lg text-sm">${content}</div>` :
                `<div class="bg-primary text-white px-3 py-2 rounded-lg text-sm">${content}</div>`;

            chatbotMessages.appendChild(div);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
        }

        async function sendChat() {
            const text = chatbotInput.value.trim();
            if (text === "") return;

            addMessage(text, "user");
            chatbotInput.value = "";

            // Loading animation
            let loading = document.createElement("div");
            loading.className = "text-gray-500 text-sm";
            loading.innerHTML = "Typing...";
            chatbotMessages.appendChild(loading);
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;

            // Send to backend
            const response = await fetch("<?= base_url('chatbot-api') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    message: text
                })
            });

            chatbotMessages.removeChild(loading);

            const data = await response.json();
            addMessage(data.reply, "bot");
        }

        chatbotSend.onclick = sendChat;

        chatbotInput.addEventListener("keypress", (e) => {
            if (e.key === "Enter") sendChat();
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const elements = document.querySelectorAll('.slide-in-left');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    } else {
                        entry.target.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.2
            });

            elements.forEach(el => observer.observe(el));
        });
    </script>

</body>

</html>