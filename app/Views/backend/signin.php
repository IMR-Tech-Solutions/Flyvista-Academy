<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flyvista - Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#20406C',
                            light: '#335B95',
                            dark: '#142947',
                        },
                        secondary: {
                            DEFAULT: '#D4A85D',
                            light: '#E2BE80',
                            dark: '#B38B45',
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
    <style>
        .glass-effect {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.85);
        }
    </style>
</head>

<body class="bg-gradient-to-r from-primary to-light min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl">
        <div class="rounded-xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-2">

                <!-- Left Side -->
                <div class="glass-effect  overflow-hidden">
                    <!-- Card Body -->
                    <div class="px-8 py-12">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= base_url('signin') ?>" method="post">
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email"
                                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                        placeholder="your@email.com" required>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        class="pl-10 w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                                        placeholder="••••••••" required>
                                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                                </div>
                                <div class="text-sm">
                                    <a href="#" class="font-medium text-primary hover:text-primary/80">Forgot password?</a>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-2 px-4 rounded-lg transition duration-200 flex items-center justify-center">
                                <span>Sign In</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- Right Side -->
                <div class="bg-primary px-6 py-12 text-center flex flex-col justify-center items-center">
                    <div class="flex justify-center mb-4">
                        <img src="<?= base_url('assets/img/Flyvista-Logo-White.png') ?>"
                            alt="FlyVista Logo"
                            class="w-24 h-24 object-contain">
                    </div>
                    <p class="text-white/90 mt-1">Admin Dashboard Login</p>
                </div>
            </div>
            <!-- Card Footer -->
            <div class="px-8 py-4 bg-gray-50 text-center">
                <p class="text-sm text-gray-600">
                    © 2025 FlyVista. All rights reserved. | Devloped and Designed by <a href="https://imrtechsolutions.com/" class="font-medium text-primary hover:text-primary/80">IMR Tech Solution</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle eye icon
            if (type === 'password') {
                this.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    </script>
</body>

</html>