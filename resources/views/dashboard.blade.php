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
                        <span class="text-lg font-semibold text-gray-700">{{ $day_calorie }}/2000</span>
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
                    @foreach($meals as $meal)
                        <div class="flex items-center justify-between py-3">
                            <div>
                                <h4 class="font-medium text-gray-900">{{ $meal->food_name }}</h4>
                                <p class="text-green-600 text-sm">Breakfast</p>
                            </div>
                            <span class="font-semibold text-gray-900">350 kcal</span>
                        </div>
                    @endForeach
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                <button onclick="document.getElementById('formModal').classList.toggle('hidden')" class="flex items-center justify-center space-x-2 bg-green-500 text-white px-6 py-3 rounded-full font-medium hover:bg-green-600 transition-colors">
                    <i data-feather="plus" class="w-5 h-5"></i>
                    <span>Add Meal</span>
                </button>
                <a href="/scan_food" class="flex items-center justify-center space-x-2 bg-gray-200 text-gray-700 px-6 py-3 rounded-full font-medium hover:bg-gray-300 transition-colors">
                    <i data-feather="camera" class="w-5 h-5"></i>
                    <span>Scan Food</span>
                </a>
            </div>
        </div>
    </div>

</x-layout>