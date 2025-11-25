<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Advanced Inventory Management System - Streamline your business operations with our powerful inventory management solution">

    <title>Advance Inventory — Smart Inventory Management System</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://img.icons8.com/color/96/000000/inventory-management.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #a855f7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .btn-primary {
            background: linear-gradient(90deg, #4f46e5, #7c3aed);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3), 0 2px 4px -1px rgba(79, 70, 229, 0.2);
        }
    </style>
</head>
<body class="antialiased font-sans bg-white">
    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" id="loginModalBackdrop"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button type="button" id="closeLoginModal" class="bg-white rounded-md text-gray-400 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Close</span>
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-2xl leading-6 font-bold text-gray-900 mb-6" id="modal-title">
                            Welcome Back
                        </h3>
                        <div class="mt-2">
                            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                                @csrf
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <div class="mt-1">
                                        <input id="email" name="email" type="email" autocomplete="email" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <div class="mt-1 relative">
                                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                            <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" id="togglePassword">
                                                <i class="far fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input id="remember-me" name="remember-me" type="checkbox" 
                                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                            Remember me
                                        </label>
                                    </div>

                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Forgot your password?
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Sign in
                                    </button>
                                </div>
                            </form>
                            
                            <div class="mt-6">
                                <div class="relative">
                                    <div class="absolute inset-0 flex items-center">
                                        <div class="w-full border-t border-gray-300"></div>
                                    </div>
                                    <div class="relative flex justify-center text-sm">
                                        <span class="px-2 bg-white text-gray-500">
                                            Or continue with
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-6 grid grid-cols-2 gap-3">
                                    <div>
                                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <i class="fab fa-google text-red-500"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                            <i class="fab fa-microsoft text-blue-500"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="mt-6 text-center">
                                    <p class="text-sm text-gray-600">
                                        Don't have an account? 
                                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                            Sign up
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md border-b border-gray-100 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-8 w-auto" src="https://img.icons8.com/color/96/000000/inventory-management.png" alt="Logo">
                        <span class="ml-2 text-xl font-bold text-gray-900">Advance<span class="gradient-text">Inventory</span></span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="#features" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Features</a>
                    {{-- <a href="{{ route('pricing') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Pricing</a> --}}
                    <a href="#contact" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Dashboard
                            </a>
                        @else
                            <button onclick="openLoginModal()" class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Sign In</button>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                <!-- Mobile menu button -->
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Features</a>
                {{-- <a href="{{ route('pricing') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Pricing</a> --}}
                <a href="#contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Contact</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-indigo-600 hover:bg-indigo-50">
                            Dashboard
                        </a>
                    @else
                        <button onclick="openLoginModal()" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Sign In</button>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-indigo-600 hover:bg-indigo-50">
                                Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient pt-24 pb-16 sm:pt-32 sm:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl" data-aos="fade-up">
                    <span class="block">Advanced Inventory</span>
                    <span class="block gradient-text">Management Solution</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl" data-aos="fade-up" data-aos-delay="100">
                    Streamline your business operations with our powerful inventory management system. Track, manage, and optimize your inventory in real-time.
                </p>
                <div class="mt-8 flex justify-center gap-4" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('register') }}" class="btn-primary text-white px-8 py-3 rounded-md text-base font-medium md:py-4 md:text-lg md:px-10">
                        Get Started Free
                    </a>
                    <a href="#features" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 md:py-4 md:text-lg md:px-8">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="mt-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-100">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Dashboard preview" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl" data-aos="fade-up">
                    Powerful Features
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Everything you need to manage your inventory efficiently
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600 mb-6">
                        <i class="fas fa-boxes text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Inventory Tracking</h3>
                    <p class="text-gray-500">Real-time tracking of all your inventory items across multiple locations with detailed reporting.</p>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center text-blue-600 mb-6">
                        <i class="fas fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Analytics & Reports</h3>
                    <p class="text-gray-500">Powerful analytics to help you make data-driven decisions and optimize your inventory.</p>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600 mb-6">
                        <i class="fas fa-sync-alt text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Automated Reordering</h3>
                    <p class="text-gray-500">Set up automatic reorder points and never run out of stock again.</p>
                </div>

                <!-- Feature 4 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 mb-6">
                        <i class="fas fa-tags text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Barcode Scanning</h3>
                    <p class="text-gray-500">Quickly scan barcodes to update inventory levels and track items.</p>
                </div>

                <!-- Feature 5 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center text-yellow-600 mb-6">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Multi-User Access</h3>
                    <p class="text-gray-500">Collaborate with your team with different permission levels and access controls.</p>
                </div>

                <!-- Feature 6 -->
                <div class="feature-card bg-white p-8 rounded-xl border border-gray-100" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center text-red-600 mb-6">
                        <i class="fas fa-mobile-alt text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Mobile Friendly</h3>
                    <p class="text-gray-500">Access your inventory from anywhere, on any device with our responsive design.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-700">
        <div class="max-w-4xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl" data-aos="fade-up">
                <span class="block">Ready to get started?</span>
                <span class="block">Start your free trial today.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200" data-aos="fade-up" data-aos-delay="100">
                No credit card required. Cancel anytime.
            </p>
            <div class="mt-8" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 md:py-4 md:text-lg md:px-10">
                    Get Started for Free
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-8 xl:col-span-1">
                    <div class="flex items-center">
                        <img class="h-8 w-auto" src="https://img.icons8.com/color/96/000000/inventory-management.png" alt="Logo">
                        <span class="ml-2 text-xl font-bold text-gray-900">Advance<span class="gradient-text">Inventory</span></span>
                    </div>
                    <p class="text-gray-500 text-base">
                        The most advanced inventory management solution for businesses of all sizes.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Twitter</span>
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">LinkedIn</span>
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="mt-12 grid grid-cols-2 gap-8 xl:mt-0 xl:col-span-2">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Solutions</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Inventory Management</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Order Management</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Warehouse Management</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Retail Management</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Support</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Help Center</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Documentation</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Guides</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">API Status</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Company</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">About</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Blog</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Careers</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Contact</a></li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Legal</h3>
                            <ul class="mt-4 space-y-4">
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Privacy</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Terms</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">Cookie Policy</a></li>
                                <li><a href="#" class="text-base text-gray-500 hover:text-gray-900">GDPR</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-200 pt-8">
                <p class="text-base text-gray-400 text-center">
                    &copy; {{ date('Y') }} AdvanceInventory. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 bg-indigo-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-indigo-700 transition-all duration-300 opacity-0 invisible">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Login Modal Functions
        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // Close modal when clicking outside
        document.getElementById('loginModalBackdrop').addEventListener('click', closeLoginModal);
        document.getElementById('closeLoginModal').addEventListener('click', closeLoginModal);

        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('fa-eye');
                eyeIcon.classList.toggle('fa-eye-slash');
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLoginModal();
            }
        });

        // Show error messages if any
        @if ($errors->has('email') || $errors->has('password'))
            openLoginModal();
        @endif
        // Initialize AOS (Animate On Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });

            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Back to top button
            const backToTopButton = document.getElementById('back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.remove('opacity-100', 'visible');
                    backToTopButton.classList.add('opacity-0', 'invisible');
                }
            });

            backToTopButton.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        // Close mobile menu if open
                        if (!mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                        
                        // Smooth scroll to target
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>