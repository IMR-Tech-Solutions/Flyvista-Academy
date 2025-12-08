

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="robots" content="noindex, nofollow" />

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="34x34" href="<?= base_url('favicon.png') ?>">

  <title>FlyVista - Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

  <!-- Place the first <script> tag in your HTML's <head> -->
  <script src="https://cdn.tiny.cloud/1/arndtw5mf8l47r92yv1iecndlmuo7kbnla0k7sk9rlhh3zpd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

  <style>
    /* Hide default DataTable elements */
    .dataTables_length,
    .dataTables_filter,
    .dt-buttons,
    .dataTables_info {
      display: none !important;
    }
  </style>

  <script>
    tailwind.config = {
      theme: {
        extend: {
            fontFamily: {
                        sans: ['"Roboto Serif"', 'serif']
                    },
          colors: {
            primary: {
                            DEFAULT: '#0F3D5F',
                            light: '#155A85',
                            dark: '#0A2A44'
                        },
            secondary: {
                            DEFAULT: '#D83030',
                            light: '#E62834',
                            dark: '#B32222'
                        },
            graylight: '#F4F5FA',
            textbody: {
              light: '#333F4D',
              dark: '#E5E7EB',
            },
            heading: {
              light: '#16243E',
              dark: '#F9FAFB',
            },
            background: {
              light: '#FFFFFF',
              dark: '#0F172A',
            },
          },
          backgroundImage: {
            'gradient-primary': 'linear-gradient(90deg, #335B95 0%, #142947 100%)',
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <?php
        $currentURL = service('uri')->getPath(); 
        ?>

        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white w-64 shadow-lg transition-all duration-300 ease-in-out flex flex-col">

            <!-- Header -->
            <div class="flex items-center justify-center p-1 border-b relative">
                <img src="<?= base_url('assets/img/flyvista-logo.png') ?>" 
                    alt="Logo" 
                    class="h-20 w-auto object-contain mx-auto">

                <button id="sidebar-toggle" 
                    class="text-white hover:text-light/20 absolute right-[-10px] bg-primary px-2 py-1 rounded-full">
                    <i class="fas fa-angle-left"></i>
                </button>
            </div>

            <!-- User Info -->
            <div class="p-4">
                <div class="flex items-center space-x-4 p-2 rounded-lg bg-primary/10">
                    <div class="p-2 rounded-full bg-primary flex items-center justify-center text-white">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <span>
                        <p class="font-medium"><?= session()->get('user_name') ?></p>
                        <p class="text-xs text-gray-500">Admin</p> <!-- Default role since your table has no role -->
                    </span>
                </div>
            </div>

            <!-- Scrollable Nav Section -->
            <div class="flex-1 overflow-y-auto px-4">
                <nav>
                    <ul class="space-y-2">

                        <!-- Dashboard -->
                        <li>
                            <a href="<?= base_url('admin') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg 
                            <?= ($currentURL == 'admin') ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Home -->
                        <?php $homeActive = (strpos($currentURL, 'admin/hero') !== false); ?>
                        <li class="relative">
                            <button id="home-dropdown-toggle"
                                class="flex items-center justify-between w-full p-2 rounded-lg 
                                <?= $homeActive ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">

                                <div class="flex items-center space-x-3">
                                    <i class="fas fa-home"></i>
                                    <span>Home</span>
                                </div>
                                <i class="fas fa-chevron-down text-sm <?= $homeActive ? 'text-white' : 'text-gray-500' ?>"></i>
                            </button>

                            <ul id="home-dropdown-menu"
                                class="<?= $homeActive ? 'block' : 'hidden' ?> ml-8 mt-1 space-y-1 bg-white rounded-md shadow-sm border border-gray-200 py-2 z-10">

                                <li>
                                    <a href="<?= base_url('admin/hero') ?>"
                                        class="block px-4 py-2 text-sm 
                                        <?= strpos($currentURL, 'admin/hero') !== false 
                                            ? 'bg-primary text-white' 
                                            : 'text-gray-700 hover:bg-gray-100' ?>">
                                        Hero Section
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- About Us -->
                        <li>
                            <a href="<?= base_url('admin/about') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/about') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-info-circle"></i>
                                <span>About Us</span>
                            </a>
                        </li>

                        <!-- Mission & Vision -->
                        <li>
                            <a href="<?= base_url('admin/mission-vision') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/mission-vision') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-bullseye"></i>
                                <span>Mission & Vision</span>
                            </a>
                        </li>

                        <!-- Why Choose -->
                        <li>
                            <a href="<?= base_url('admin/why-choose') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/why-choose') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-star"></i>
                                <span>Why Choose</span>
                            </a>
                        </li>

                        <!-- Counter Section -->
                        <li>
                            <a href="<?= base_url('admin/counters') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/counters') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-chart-line"></i>
                                <span>Counter Section</span>
                            </a>
                        </li>

                        <!-- Team Members -->
                        <li>
                            <a href="<?= base_url('admin/leaders') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/leaders') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-users"></i>
                                <span>Team leaders</span>
                            </a>
                        </li>

                        <!-- Our Courses -->
                        <li>
                            <a href="<?= base_url('admin/courses') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/courses') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-book-open"></i>
                                <span>Our Courses</span>
                            </a>
                        </li>

                        <!-- Flagship Program -->
                        <li>
                            <a href="<?= base_url('admin/flagship_program') ?>"
                                class="flex items-center space-x-3 p-2 rounded-lg
                                <?= strpos($currentURL, 'admin/flagship_program') !== false
                                    ? 'bg-primary text-white'
                                    : 'hover:bg-gray-100' ?>">
                                    <i class="fas fa-rocket mr-3"></i>
                                Flagship Program
                            </a>
                        </li>

                        <!-- Course Details -->
                        <li>
                            <a href="<?= base_url('admin/course-details') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/course-details') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-book"></i>
                                <span>Course Details</span>
                            </a>
                        </li>

                        <!-- Admission Process -->
                        <li>
                            <a href="<?= base_url('admin/admission') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/admission') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-tasks"></i>
                                <span>Admission Process</span>
                            </a>
                        </li>

                        <!-- Testimonial -->
                        <li>
                            <a href="<?= base_url('admin/testimonials') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/testimonials') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-comment-dots"></i>
                                <span>Testimonial</span>
                            </a>
                        </li>

                        <!-- Blog -->
                        <li>
                            <a href="<?= base_url('admin/blogs') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/blogs') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-blog"></i>
                                <span>Blog</span>
                            </a>
                        </li>

                        <!-- Blog Details -->
                        <li>
                            <a href="<?= base_url('admin/blog-details') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/blog-details') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-file-alt"></i>
                                <span>Blog Details</span>
                            </a>
                        </li>

                        <!-- Success Stories -->
                        <li>
                            <a href="<?= base_url('admin/success-stories') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/success-stories') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-trophy"></i>
                                <span>Success Stories</span>
                            </a>
                        </li>

                        <!-- Documents -->
                        <li>
                            <a href="<?= base_url('admin/documents') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/documents') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-file"></i>
                                <span>Documents</span>
                            </a>
                        </li>

                        <!-- FAQ -->
                        <li>
                            <a href="<?= base_url('admin/faqs') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/faqs') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-question-circle"></i>
                                <span>FAQ</span>
                            </a>
                        </li>

                        <!-- Career Placement -->
                        <li>
                            <a href="<?= base_url('admin/placement-career') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/placement-career') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Career Placement</span>
                            </a>
                        </li>

                        <!-- Career Feature -->
                        <li>
                            <a href="<?= base_url('admin/career-features') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/career-features') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-briefcase"></i>
                                <span>Career Feature</span>
                            </a>
                        </li>

                        <!-- Career Detail -->
                        <li>
                            <a href="<?= base_url('admin/jobs') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/jobs') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-file-contract"></i>
                                <span>Job Detail</span>
                            </a>
                        </li>

                        <!-- Job Applications -->
                        <li>
                            <a href="<?= base_url('admin/job-applications') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/job-applications') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-users-cog"></i>
                                <span>Job Applications</span>
                            </a>
                        </li>

                        <!-- Course Applications -->
                        <li>
                            <a href="<?= base_url('admin/course-applications') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/course-applications') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-file-signature"></i>
                                <span>Course Applications</span>
                            </a>
                        </li>

                        <!-- Breadcrumb -->
                        <li>
                            <a href="<?= base_url('admin/breadcrumb-sections') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/breadcrumb-sections') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-route"></i>
                                <span>Breadcrumb</span>
                            </a>
                        </li>


                        <!-- Contact Info -->
                        <li>
                            <a href="<?= base_url('admin/contact-info') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/contact-info') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-address-book"></i>
                                <span>Contact Info</span>
                            </a>
                        </li>

                        <!-- Contact Form -->
                        <li>
                            <a href="<?= base_url('admin/contact-form') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/contact-form') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-envelope"></i>
                                <span>Contact Form</span>
                            </a>
                        </li>

                        <!-- Contact Messages -->
                        <li>
                            <a href="<?= base_url('admin/contact-messages') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/contact-messages') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-envelope-open-text"></i>
                                <span>Contact Messages</span>
                            </a>
                        </li>

                        <!-- Privacy Policy -->
                        <li>
                            <a href="<?= base_url('admin/privacy-policies') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/privacy-policies') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-user-shield"></i>
                                <span>Privacy Policy</span>
                            </a>
                        </li>

                        <!-- Terms & Conditions -->
                        <li>
                            <a href="<?= base_url('admin/terms') ?>"
                            class="flex items-center space-x-3 p-2 rounded-lg
                            <?= strpos($currentURL, 'admin/terms') !== false ? 'bg-primary text-white' : 'hover:bg-gray-100' ?>">
                                <i class="fas fa-gavel"></i>
                                <span>Terms & Conditions</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Footer Logout -->
            <div class="px-4 py-2 border-t">
                <a href="<?= base_url('logout') ?>" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Topbar -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center space-x-4">
                        <div class="pl-2 d-flex">
                            <h1 class="text-xl font-semibold text-dark">Welcome, <?= session()->get('user_name') ?></h1>
                            <span>You are logged in as Admin</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button class="p-2 rounded-full hover:bg-gray-100">
                                <i class="fas fa-bell text-gray-600"></i>
                                <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                        <div class="relative">
                            <button id="user-menu-button" class="flex items-center space-x-2 focus:outline-none">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white">
                                    <span>
                                        <img src="<?= base_url('assets/img/users/' . session()->get('profile_photo')) ?>" alt="Profile Photo" class="w-10 h-8 rounded-full">
                                    </span>
                                </div>
                                <?php
                                $name = session()->get('user_name');
                                $initials = '';

                                if (!empty($name)) {
                                    $parts = explode(' ', trim($name));
                                    $first = $parts[0] ?? '';
                                    $last = $parts[1] ?? '';

                                    $initials = strtoupper(substr($first, 0, 1) . substr($last, 0, 1));
                                }
                                ?>
                                <span class="hidden md:inline"><?= $initials ?></span>

                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div id="user-menu-dropdown"
                                class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                <a href="<?= base_url('admin/user') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Manage Users</a>
                                <a href="<?= base_url('logout') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>