<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrition Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <style>
        .progress-bar {
            background: linear-gradient(to right, #10b981, #34d399);
        }
        .nav-active {
            background: linear-gradient(to right, #dbeafe, #eff6ff);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Mobile Header -->
        <div class="lg:hidden bg-white shadow-sm sticky top-0 z-50">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center space-x-3">
                    <img 
                        src="https://images.unsplash.com/photo-1494790108755-2616b169ad04?w=48&h=48&fit=crop&crop=face&auto=format" 
                        alt="Profile" 
                        class="w-12 h-12 rounded-full object-cover"
                    />
                    <span class="text-gray-800 font-medium">John Doe</span>
                </div>
                <div class="flex items-center space-x-4">
                    <i data-feather="bell" class="w-6 h-6 text-gray-600"></i>
                    <i data-feather="menu" class="w-6 h-6 text-gray-600 cursor-pointer" onclick="toggleMobileMenu()"></i>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-3">
                            <img 
                                src="https://images.unsplash.com/photo-1494790108755-2616b169ad04?w=48&h=48&fit=crop&crop=face&auto=format" 
                                alt="Profile" 
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div>
                                <h2 class="text-gray-800 font-semibold">John Doe</h2>
                                <p class="text-gray-500 text-sm">Nutrition Tracker</p>
                            </div>
                        </div>
                        <i data-feather="x" class="w-6 h-6 text-gray-600 cursor-pointer" onclick="toggleMobileMenu()"></i>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="#" class="flex items-center space-x-3 p-3 text-blue-600 bg-blue-50 rounded-lg">
                            <i data-feather="home" class="w-5 h-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                            <span>History</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i data-feather="user" class="w-5 h-5"></i>
                            <span>Profile</span>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="flex">
            <!-- Desktop Sidebar -->
            <div class="hidden lg:block w-64 bg-white h-screen shadow-lg sticky top-0">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-8">
                        <img 
                            src="https://images.unsplash.com/photo-1494790108755-2616b169ad04?w=48&h=48&fit=crop&crop=face&auto=format" 
                            alt="Profile" 
                            class="w-12 h-12 rounded-full object-cover"
                        />
                        <div>
                            <h2 class="text-gray-800 font-semibold">John Doe</h2>
                            <p class="text-gray-500 text-sm">Nutrition Tracker</p>
                        </div>
                    </div>
                    
                    <nav class="space-y-2">
                        <a href="#" class="flex items-center space-x-3 p-3 text-blue-600 bg-blue-50 rounded-lg">
                            <i data-feather="home" class="w-5 h-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                            <span>History</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                            <i data-feather="user" class="w-5 h-5"></i>
                            <span>Profile</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <div class="max-w-4xl mx-auto p-4 lg:p-8">
                    <!-- Desktop Header -->
                    <div class="hidden lg:flex items-center justify-between mb-8">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Nutrition Dashboard</h1>
                            <p class="text-gray-600 mt-1">Track your daily nutrition goals</p>
                        </div>
                        <i data-feather="bell" class="w-6 h-6 text-gray-600 cursor-pointer hover:text-gray-800"></i>
                    </div>

                    <!-- Date Selector -->
                    <div class="bg-gray-200 rounded-lg p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2 text-gray-700">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                                <span class="font-medium">Mon, 07 July 2025</span>
                            </div>
                            <i data-feather="chevron-down" class="w-5 h-5 text-gray-500"></i>
                        </div>
                    </div>

                    <!-- Stats Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                        <!-- Calories Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold text-gray-900">Calories</h3>
                                <span class="text-lg font-semibold text-gray-700">1200/2000</span>
                            </div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                                <div class="progress-bar h-3 rounded-full" style="width: 60%"></div>
                            </div>
                            
                            <p class="text-gray-600">
                                <span class="text-green-600 font-medium">Remaining: </span>
                                <span class="font-semibold">800</span>
                            </p>
                        </div>

                        <!-- Macros Card -->
                        <div class="bg-white rounded-2xl p-6 shadow-sm">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Macros</h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="border border-gray-200 rounded-xl p-4 text-center">
                                    <p class="text-gray-600 font-medium">Protein</p>
                                    <p class="text-2xl font-bold text-gray-900">80g</p>
                                </div>
                                <div class="border border-gray-200 rounded-xl p-4 text-center">
                                    <p class="text-gray-600 font-medium">Carbs</p>
                                    <p class="text-2xl font-bold text-gray-900">150g</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Water Intake -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm mb-8">
                        <div class="border border-gray-200 rounded-xl p-6 text-center">
                            <p class="text-gray-600 font-medium mb-2">Water</p>
                            <p class="text-3xl font-bold text-gray-900">2L</p>
                        </div>
                    </div>

                    <!-- Meals Section -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Meals</h3>
                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <h4 class="font-medium text-gray-900">Oatmeal with Berries</h4>
                                    <p class="text-green-600 text-sm">Breakfast</p>
                                </div>
                                <span class="font-semibold text-gray-900">350 kcal</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <h4 class="font-medium text-gray-900">Chicken Salad</h4>
                                    <p class="text-green-600 text-sm">Lunch</p>
                                </div>
                                <span class="font-semibold text-gray-900">450 kcal</span>
                            </div>
                            
                            <div class="flex items-center justify-between py-3">
                                <div>
                                    <h4 class="font-medium text-gray-900">Salmon with Vegetables</h4>
                                    <p class="text-green-600 text-sm">Dinner</p>
                                </div>
                                <span class="font-semibold text-gray-900">400 kcal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mb-8">
                        <button class="flex items-center justify-center space-x-2 bg-green-500 text-white px-6 py-3 rounded-full font-medium hover:bg-green-600 transition-colors">
                            <i data-feather="plus" class="w-5 h-5"></i>
                            <span>Add Meal</span>
                        </button>
                        <button class="flex items-center justify-center space-x-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-300 transition-colors">
                            <i data-feather="camera" class="w-5 h-5"></i>
                            <span>Scan Food</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Bottom Navigation -->
        <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t">
            <div class="flex items-center justify-around py-2">
                <a href="#" class="flex flex-col items-center p-3 text-blue-600">
                    <i data-feather="home" class="w-6 h-6"></i>
                    <span class="text-xs font-medium mt-1">Dashboard</span>
                </a>
                <a href="#" class="flex flex-col items-center p-3 text-gray-600">
                    <i data-feather="calendar" class="w-6 h-6"></i>
                    <span class="text-xs mt-1">History</span>
                </a>
                <a href="#" class="flex flex-col items-center p-3 text-gray-600">
                    <i data-feather="user" class="w-6 h-6"></i>
                    <span class="text-xs mt-1">Profile</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Mobile Menu Toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        // Close mobile menu when clicking outside
        document.getElementById('mobile-menu').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleMobileMenu();
            }
        });

        // Smooth animations for progress bars
        window.addEventListener('load', function() {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                bar.style.transition = 'width 1s ease-in-out';
            });
        });
    </script>
</body>
</html>