    @php
        $user = Auth::user();
    @endphp

    <x-layout title="dashboard">
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
                            <span class="text-lg font-semibold text-gray-700" id="calories-count">{{ $day_calorie }}/2000</span>
                        </div>
                        
                        <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                            <div class="progress-bar h-3 rounded-full bg-green-500" id="calories-progress" style="width: {{ ($day_calorie / 2000) * 100 }}%"></div>
                        </div>
                        
                        <p class="text-gray-600">
                            <span class="text-green-600 font-medium">Remaining: </span>
                            <span class="font-semibold" id="calories-remaining">{{ 2000 - $day_calorie }}</span>
                        </p>
                    </div>

                    <!-- Macros Card -->
                    <div class="bg-white rounded-2xl p-6 shadow-sm">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Macros</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="border border-gray-200 rounded-xl p-4 text-center">
                                <p class="text-gray-600 font-medium">Protein</p>
                                <p class="text-2xl font-bold text-gray-900" id="protein-count">80g</p>
                            </div>
                            <div class="border border-gray-200 rounded-xl p-4 text-center">
                                <p class="text-gray-600 font-medium">Carbs</p>
                                <p class="text-2xl font-bold text-gray-900" id="carbs-count">150g</p>
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
                    
                    <!-- Drag & Drop Area -->
                    <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center mb-6 transition-colors duration-200 hover:border-blue-400 hover:bg-blue-50 cursor-pointer">
                        <i data-feather="upload" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
                        <p class="text-gray-600 mb-2">Drag & drop food image here</p>
                        <p class="text-sm text-gray-500">or click to upload</p>
                    </div>
                    <input type="file" id="fileInput" accept="image/*" class="hidden">

                    <!-- Existing Meals from Database -->
                    <div class="space-y-4 mb-6">
                        @foreach($meals as $meal)
                            <div class="flex items-center justify-between py-3 px-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $meal->food_name }}</h4>
                                        <p class="text-sm text-gray-500">{{$meal->calories}} • 15g protein • 45g carbs</p>
                                    </div>
                                </div>
                                <button class="delete-meal text-red-500 hover:text-red-700" data-id="{{ $meal->id }}">
                                    <i data-feather="trash-2" class="w-4 h-4" ></i>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Quick Add Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Quick Add</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <button class="quick-add-btn p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-left" data-food="Nasi Putih" data-calories="200">
                                <p class="font-medium text-gray-800">Nasi Putih</p>
                                <p class="text-sm text-gray-500">200 cal</p>
                            </button>
                            <button class="quick-add-btn p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-left" data-food="Ayam Goreng" data-calories="350">
                                <p class="font-medium text-gray-800">Ayam Goreng</p>
                                <p class="text-sm text-gray-500">350 cal</p>
                            </button>
                            <button class="quick-add-btn p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-left" data-food="Telur Dadar" data-calories="150">
                                <p class="font-medium text-gray-800">Telur Dadar</p>
                                <p class="text-sm text-gray-500">150 cal</p>
                            </button>
                            <button class="quick-add-btn p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors text-left" data-food="Tempe Goreng" data-calories="180">
                                <p class="font-medium text-gray-800">Tempe Goreng</p>
                                <p class="text-sm text-gray-500">180 cal</p>
                            </button>
                        </div>
                    </div>

                    <!-- Today's Dynamic Meals -->
                    <div id="mealsList">
                        <h3 class="text-lg font-semibold text-gray-700 mb-3">Today's Added Meals</h3>
                        <div class="space-y-3" id="mealsContainer">
                            <!-- Dynamic meals will be populated here -->
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <button id="addMealBtn" type="button" class="flex items-center justify-center space-x-2 bg-green-500 text-white px-6 py-3 rounded-full font-medium hover:bg-green-600 transition-colors">
                        <i data-feather="plus" class="w-5 h-5"></i>
                        <span>Add Meal</span>
                    </button>
                    <a href="/scan_food" class="flex items-center justify-center space-x-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-300 transition-colors">
                        <i data-feather="camera" class="w-5 h-5"></i>
                        <span>Scan Food</span>
                    </a>
                </div>

                <!-- Manual Input Modal -->
        <div id="manualModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 flex">
            <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Add Food Manually</h3>
                    <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                        <i data-feather="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <form id="manualForm" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Food Name</label>
                        <input type="text" id="foodName" name="food_name" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="e.g., Nasi Goreng" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Calories</label>
                        <input type="number" id="foodCalories" name="calories" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="e.g., 450" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Protein (g)</label>
                            <input type="number" id="foodProtein" name="protein" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="15">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Carbs (g)</label>
                            <input type="number" id="foodCarbs" name="carbs" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="65">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meal Type</label>
                        <select id="mealType" name="meal_type" class="w-full p-3 border border-gray-300 rounded-lg">
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snack">Snack</option>
                        </select>
                    </div>
                    <div class="flex space-x-3 pt-4">
                        <button type="button" id="cancelBtn" class="flex-1 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="flex-1 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600">Add Food</button>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/food-detection.js') }}"></script>
    </x-layout>