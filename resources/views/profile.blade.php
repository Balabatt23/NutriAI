<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Sophia Carter</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles untuk mobile responsiveness */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .profile-avatar {
            background: linear-gradient(135deg, #fde2d4 0%, #f4d0c4 100%);
        }
        
        .toggle-switch {
            transition: all 0.3s ease;
        }
        
        .toggle-switch.active {
            background-color: #10b981;
        }
        
        .toggle-switch.active .toggle-circle {
            transform: translateX(20px);
        }
        
        @media (min-width: 768px) {
            .toggle-switch.active .toggle-circle {
                transform: translateX(26px);
            }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen md:bg-gray-100">
    <!-- Responsive Container -->
    <div class="max-w-sm mx-auto bg-white min-h-screen md:max-w-4xl md:shadow-xl md:rounded-xl md:my-8 md:overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-white border-b border-gray-100">
            <button class="p-2 -ml-2" onclick="goBack()">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-900">Profile</h1>
            <div class="w-10"></div>
        </div>

        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-white border-b border-gray-100 md:p-6">
            <button class="p-2 -ml-2 md:hidden" onclick="goBack()">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            <h1 class="text-xl font-semibold text-gray-900 md:text-2xl">Profile</h1>
            <div class="w-10 md:hidden"></div>
        </div>

        <!-- Desktop Layout -->
        <div class="md:grid md:grid-cols-3 md:gap-8 md:p-6">
            <!-- Left Column - Profile Info -->
            <div class="md:col-span-1">
                <!-- Profile Section -->
                <div class="px-6 py-8 text-center md:px-0">
                    <!-- Avatar -->
                    <div class="profile-avatar w-32 h-32 rounded-full mx-auto mb-6 flex items-center justify-center md:w-40 md:h-40">
                        <div class="w-28 h-28 rounded-full overflow-hidden md:w-36 md:h-36">
                            <svg viewBox="0 0 120 120" class="w-full h-full">
                                <!-- Hair -->
                                <path d="M30 45 Q25 35 35 30 Q45 25 60 28 Q75 25 85 30 Q95 35 90 45 Q92 55 85 65 Q80 70 75 68 Q70 72 65 70 Q60 74 55 70 Q50 72 45 68 Q40 70 35 65 Q28 55 30 45 Z" fill="#8B4513"/>
                                
                                <!-- Face -->
                                <circle cx="60" cy="60" r="25" fill="#D2B48C"/>
                                
                                <!-- Eyes -->
                                <circle cx="54" cy="55" r="2" fill="#000"/>
                                <circle cx="66" cy="55" r="2" fill="#000"/>
                                
                                <!-- Eyebrows -->
                                <path d="M50 50 Q54 48 58 50" stroke="#8B4513" stroke-width="1.5" fill="none"/>
                                <path d="M62 50 Q66 48 70 50" stroke="#8B4513" stroke-width="1.5" fill="none"/>
                                
                                <!-- Nose -->
                                <path d="M60 58 Q61 62 60 64" stroke="#B8860B" stroke-width="0.5" fill="none"/>
                                
                                <!-- Lips -->
                                <path d="M57 68 Q60 70 63 68" stroke="#CD5C5C" stroke-width="1.5" fill="none"/>
                                
                                <!-- Neck -->
                                <rect x="55" y="82" width="10" height="8" fill="#D2B48C"/>
                                
                                <!-- Top -->
                                <path d="M45 88 Q50 85 60 88 Q70 85 75 88 L75 110 L45 110 Z" fill="#FFF"/>
                                
                                <!-- Hair details -->
                                <path d="M35 40 Q40 38 45 42 Q50 38 55 42 Q60 38 65 42 Q70 38 75 42 Q80 38 85 40" stroke="#654321" stroke-width="1" fill="none"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Name -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 md:text-3xl">Sophia Carter</h2>
                    <button class="text-green-600 font-medium text-sm md:text-base hover:text-green-700 transition-colors" onclick="editProfile()">Edit Profile</button>
                </div>
            </div>

            <!-- Right Column - Information -->
            <div class="md:col-span-2">
                <!-- Personal Information -->
                <div class="px-6 pb-6 md:px-0">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 md:text-xl">Personal Information</h3>
                    
                    <!-- Desktop Grid Layout -->
                    <div class="md:grid md:grid-cols-2 md:gap-6">
                        <!-- Age -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-1 md:text-lg">Age</label>
                            <p class="text-green-600 text-lg md:text-xl">28</p>
                        </div>

                        <!-- Height -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-1 md:text-lg">Height</label>
                            <p class="text-green-600 text-lg md:text-xl">5'6"</p>
                        </div>

                        <!-- Weight -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-1 md:text-lg">Weight</label>
                            <p class="text-green-600 text-lg md:text-xl">145 lbs</p>
                        </div>

                        <!-- Dietary Goal -->
                        <div class="mb-8">
                            <label class="block text-gray-700 font-medium mb-1 md:text-lg">Dietary Goal</label>
                            <p class="text-green-600 text-lg md:text-xl">Weight Loss</p>
                        </div>
                    </div>
                </div>

                <!-- App Settings -->
                <div class="px-6 pb-6 md:px-0">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 md:text-xl">App Settings</h3>
                    
                    <!-- Notifications -->
                    <div class="flex items-center justify-between py-3 md:py-4">
                        <span class="text-gray-700 font-medium md:text-lg">Notifications</span>
                        <div class="toggle-switch w-12 h-6 bg-gray-300 rounded-full relative cursor-pointer hover:bg-gray-400 transition-colors md:w-14 md:h-7" onclick="toggleNotifications()">
                            <div class="toggle-circle w-5 h-5 bg-white rounded-full absolute top-0.5 left-0.5 transition-transform duration-300 md:w-6 md:h-6"></div>
                        </div>
                    </div>

                    <!-- Help & Support -->
                    <div class="flex items-center justify-between py-3 cursor-pointer hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors md:py-4" onclick="goToHelp()">
                        <span class="text-gray-700 font-medium md:text-lg">Help & Support</span>
                        <svg class="w-5 h-5 text-gray-400 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-sm bg-white border-t border-gray-200 md:hidden">
            <div class="flex justify-around py-3">
                <!-- Home -->
                <button class="flex flex-col items-center py-1" onclick="goToHome()">
                    <svg class="w-6 h-6 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="text-xs text-gray-500">Home</span>
                </button>

                <!-- History -->
                <button class="flex flex-col items-center py-1" onclick="goToHistory()">
                    <div class="w-6 h-6 bg-green-600 rounded-sm flex items-center justify-center mb-1">
                        <span class="text-white text-xs font-bold">12</span>
                    </div>
                    <span class="text-xs text-gray-500">History</span>
                </button>

                <!-- Profile -->
                <button class="flex flex-col items-center py-1">
                    <div class="w-6 h-6 bg-black rounded-full mb-1"></div>
                    <span class="text-xs font-medium text-black">Profile</span>
                </button>
            </div>
        </div>

        <!-- Spacer for bottom navigation -->
        <div class="h-16 md:h-0"></div>
    </div>

    <script>
        let notificationsEnabled = false;

        function goBack() {
            alert('Navigate back');
        }

        function editProfile() {
            alert('Edit profile functionality');
        }

        function toggleNotifications() {
            const toggle = document.querySelector('.toggle-switch');
            notificationsEnabled = !notificationsEnabled;
            
            if (notificationsEnabled) {
                toggle.classList.add('active');
            } else {
                toggle.classList.remove('active');
            }
        }

        function goToHelp() {
            alert('Navigate to Help & Support');
        }

        function goToHome() {
            alert('Navigate to Home');
        }

        function goToHistory() {
            alert('Navigate to History');
        }
    </script>
</body>
</html>