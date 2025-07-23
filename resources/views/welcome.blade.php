    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>NutriAI - Transform Your Health</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
            
            body {
                font-family: 'Inter', sans-serif;
            }
            
            .gradient-bg {
                background: linear-gradient(135deg, #4ade80 0%, #06b6d4 100%);
            }
            
            .food-float {
                animation: float 3s ease-in-out infinite;
            }
            
            .food-float:nth-child(odd) {
                animation-delay: -1s;
            }
            
            .food-float:nth-child(even) {
                animation-delay: -2s;
            }
            
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-20px); }
            }
            
            .hero-gradient {
                background: linear-gradient(135deg, #065f46 0%, #047857 50%, #0d9488 100%);
            }
            
            .card-hover {
                transition: all 0.3s ease;
            }
            
            .card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            }
            
            .phone-mockup {
                perspective: 1000px;
            }
            
            .phone-3d {
                transform: rotateY(-10deg) rotateX(5deg);
                transition: transform 0.5s ease;
            }
            
            .phone-3d:hover {
                transform: rotateY(-5deg) rotateX(2deg);
            }
            
            .pulse-ring {
                animation: pulse-ring 2s infinite;
            }
            
            @keyframes pulse-ring {
                0% { transform: scale(1); opacity: 1; }
                80%, 100% { transform: scale(1.2); opacity: 0; }
            }
        </style>
    </head>
    <body class="bg-gray-50">
        <!-- Header -->
        <header class="fixed top-0 w-full bg-white/90 backdrop-blur-md z-50 border-b border-gray-200">
            <div class="container mx-auto px-4 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">NA</span>
                        </div>
                        <span class="text-xl font-bold text-gray-900">NutriAI</span>
                    </div>
                    
                    <nav class="hidden md:flex items-center space-x-8">
                        <a href="#features" class="text-gray-600 hover:text-emerald-600 transition-colors">Features</a>
                        <a href="#how-it-works" class="text-gray-600 hover:text-emerald-600 transition-colors">How It Works</a>
                        <a href="#testimonials" class="text-gray-600 hover:text-emerald-600 transition-colors">Testimonials</a>
                        <a href="#pricing" class="text-gray-600 hover:text-emerald-600 transition-colors">Pricing</a>
                    </nav>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="hidden md:block text-gray-600 hover:text-emerald-600 transition-colors">Sign In</a>
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white px-6 py-2 rounded-full transition-colors">
                            <a href="{{ route('registrasi') }}">
                                Get Started
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center hero-gradient overflow-hidden">
            <!-- Floating Food Elements -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-20 left-10 food-float">
                    <div class="w-12 h-12 bg-orange-400 rounded-full flex items-center justify-center text-2xl">🍊</div>
                </div>
                <div class="absolute top-32 right-20 food-float">
                    <div class="w-16 h-16 bg-yellow-400 rounded-full flex items-center justify-center text-3xl">🍌</div>
                </div>
                <div class="absolute top-64 left-20 food-float">
                    <div class="w-10 h-10 bg-red-400 rounded-full flex items-center justify-center text-xl">🍎</div>
                </div>
                <div class="absolute bottom-32 right-10 food-float">
                    <div class="w-14 h-14 bg-green-400 rounded-full flex items-center justify-center text-2xl">🥦</div>
                </div>
                <div class="absolute bottom-20 left-1/4 food-float">
                    <div class="w-12 h-12 bg-purple-400 rounded-full flex items-center justify-center text-2xl">🍇</div>
                </div>
            </div>

            <div class="container mx-auto px-4 py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="text-white space-y-8">
                        <div class="space-y-6">
                            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                                Track Your Calories,
                                <span class="text-emerald-300">Transform Your Health</span>
                            </h1>
                            <p class="text-xl md:text-2xl text-emerald-100 leading-relaxed">
                                Effortlessly monitor your daily calorie intake and achieve your wellness goals with our intuitive app. Snap a photo or scan your food to instantly calculate calories.
                            </p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="relative bg-emerald-500 hover:bg-emerald-400 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                                <span class="absolute inset-0 bg-white/20 rounded-full pulse-ring"></span>
                                Get Started Free
                            </button>
                            <button class="border-2 border-white text-white hover:bg-white hover:text-emerald-900 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300">
                                Watch Demo
                            </button>
                        </div>
                        
                        <div class="flex items-center space-x-8 pt-8">
                            <div class="text-center">
                                <div class="text-3xl font-bold">50K+</div>
                                <div class="text-emerald-200">Active Users</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">1M+</div>
                                <div class="text-emerald-200">Foods Tracked</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold">4.9★</div>
                                <div class="text-emerald-200">App Rating</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Phone Mockup -->
                    <div class="flex justify-center phone-mockup">
                        <div class="relative phone-3d">
                            <div class="w-80 h-[600px] bg-black rounded-[3rem] p-4 shadow-2xl">
                                <div class="w-full h-full bg-white rounded-[2.5rem] overflow-hidden relative">
                                    <!-- Phone Status Bar -->
                                    <div class="bg-teal-500 h-12 flex items-center justify-between px-6 text-white text-sm">
                                        <span>9:41</span>
                                        <div class="flex space-x-1">
                                            <div class="w-1 h-1 bg-white rounded-full"></div>
                                            <div class="w-1 h-1 bg-white rounded-full"></div>
                                            <div class="w-1 h-1 bg-white rounded-full"></div>
                                        </div>
                                        <span>100%</span>
                                    </div>
                                    
                                    <!-- App Interface -->
                                    <div class="p-6 space-y-4">
                                        <div class="flex items-center justify-between">
                                            <h2 class="text-2xl font-bold text-gray-900">CalorieTracker</h2>
                                            <div class="w-8 h-8 bg-teal-500 rounded-full"></div>
                                        </div>
                                        
                                        <div class="bg-teal-50 rounded-2xl p-4">
                                            <div class="text-sm text-teal-700 mb-2">Today's Progress</div>
                                            <div class="flex items-center space-x-4">
                                                <div class="w-16 h-16 bg-teal-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-bold">75%</span>
                                                </div>
                                                <div>
                                                    <div class="text-2xl font-bold text-gray-900">1,425</div>
                                                    <div class="text-sm text-gray-600">of 1,900 calories</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-3">
                                            <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">🍳</div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-gray-900">Breakfast</div>
                                                    <div class="text-sm text-gray-600">450 calories</div>
                                                </div>
                                                <div class="text-teal-600 font-semibold">+</div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">🥗</div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-gray-900">Lunch</div>
                                                    <div class="text-sm text-gray-600">620 calories</div>
                                                </div>
                                                <div class="text-teal-600 font-semibold">+</div>
                                            </div>
                                            
                                            <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">🥤</div>
                                                <div class="flex-1">
                                                    <div class="font-semibold text-gray-900">Snack</div>
                                                    <div class="text-sm text-gray-600">155 calories</div>
                                                </div>
                                                <div class="text-teal-600 font-semibold">+</div>
                                            </div>
                                        </div>
                                        
                                        <div class="bg-teal-500 rounded-full py-4 text-center">
                                            <span class="text-white font-semibold">Scan Food</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        Why Choose CalorieTracker?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Our innovative features make calorie tracking simple, accurate, and enjoyable
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">📸</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Photo Recognition</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Simply snap a photo of your meal and our AI instantly identifies foods and calculates calories with 95% accuracy.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">📊</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Smart Analytics</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Get detailed insights into your nutrition patterns, macro breakdown, and progress toward your health goals.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">🎯</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Goal Setting</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Set personalized calorie and nutrition goals based on your lifestyle, activity level, and health objectives.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">🍽️</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Meal Planning</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Plan your meals in advance with our recipe database and automatically track your projected calorie intake.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">🏃</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Exercise Integration</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Connect with fitness apps to automatically adjust your calorie goals based on your activity and workouts.
                        </p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-lg card-hover border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mb-6">
                            <span class="text-white text-2xl">👥</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Community Support</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Join a community of health-conscious users, share progress, and get motivation from others on similar journeys.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="how-it-works" class="py-20 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                        How It Works
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Get started with CalorieTracker in just three simple steps
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="relative mb-8">
                            <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white text-3xl font-bold">1</span>
                            </div>
                            <div class="hidden md:block absolute top-12 left-full w-32 h-0.5 bg-emerald-200"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Snap or Scan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Take a photo of your meal or scan the barcode of packaged foods for instant recognition.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="relative mb-8">
                            <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white text-3xl font-bold">2</span>
                            </div>
                            <div class="hidden md:block absolute top-12 left-full w-32 h-0.5 bg-emerald-200"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">AI Analysis</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Our advanced AI analyzes your food and provides detailed nutritional information including calories, macros, and vitamins.
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="relative mb-8">
                            <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <span class="text-white text-3xl font-bold">3</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Track Progress</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Monitor your daily intake, view progress charts, and adjust your goals as you work towards better health.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 gradient-bg">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Ready to Transform Your Health?
                    </h2>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Join thousands of users who have already improved their nutrition and achieved their wellness goals with CalorieTracker.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-emerald-600 hover:bg-gray-100 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                            Get Started Free
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:text-emerald-600 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300">
                            Download App
                        </button>
                    </div>
                    <div class="mt-8 text-white/80">
                        <span class="text-sm">Free forever • No credit card required • Available on iOS & Android</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-sm">NA</span>
                            </div>
                            <span class="text-xl font-bold">NutriAI</span>
                        </div>
                        <p class="text-gray-400 mb-4">
                            Transform your health with smart calorie tracking and AI-powered nutrition insights.
                        </p>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Product</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Download</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">API</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Company</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors">About</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="font-semibold mb-4">Support</h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                            <li><a href="#" class="hover:text-white transition-colors">Community</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; 2025 CalorieTracker. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script>
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Header background opacity on scroll
            window.addEventListener('scroll', () => {
                const header = document.querySelector('header');
                if (window.scrollY > 100) {
                    header.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
                } else {
                    header.style.backgroundColor = 'rgba(255, 255, 255, 0.9)';
                }
            });

            // Add loading animation to CTA buttons
            document.querySelectorAll('button').forEach(button => {
                button.addEventListener('click', function() {
                    const originalText = this.textContent;
                    this.textContent = 'Loading...';
                    this.disabled = true;
                    
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.disabled = false;
                    }, 2000);
                });
            });
        </script>
    </body>
    </html>