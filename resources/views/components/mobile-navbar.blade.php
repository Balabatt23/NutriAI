@props([
    'user'
])


<!-- The only way to do great work is to love what you do. - Steve Jobs -->
<!-- Mobile Header -->
<div class="lg:hidden bg-white shadow-sm sticky top-0 z-50">
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center space-x-3">
            <img 
                src="https://images.unsplash.com/photo-1494790108755-2616b169ad04?w=48&h=48&fit=crop&crop=face&auto=format" 
                alt="Profile" 
                class="w-12 h-12 rounded-full object-cover"
            />
            <span class="text-gray-800 font-medium">{{ $user->username }}</span>
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
                        <h2 class="text-gray-800 font-semibold">{{ $user->username }}</h2>
                        <p class="text-gray-500 text-sm">Nutrition Tracker</p>
                    </div>
                </div>
                <i data-feather="x" class="w-6 h-6 text-gray-600 cursor-pointer" onclick="toggleMobileMenu()"></i>
            </div>
            
            <nav class="space-y-2">
                <a href="/dashboard" class="flex items-center space-x-3 p-3 text-blue-600 bg-blue-50 rounded-lg">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/history" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>History</span>
                </a>
                <a href="/profile" class="flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i data-feather="user" class="w-5 h-5"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </div>
    </div>
</div>

{{ $slot }}
<!-- Mobile Bottom Navigation -->
<div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t">
    <div class="flex items-center justify-around py-2">
        <a href="/dashboard" class="flex flex-col items-center p-3 text-blue-600">
            <i data-feather="home" class="w-6 h-6"></i>
            <span class="text-xs font-medium mt-1">Dashboard</span>
        </a>
        <a href="/history" class="flex flex-col items-center p-3 text-gray-600">
            <i data-feather="calendar" class="w-6 h-6"></i>
            <span class="text-xs mt-1">History</span>
        </a>
        <a href="/profile" class="flex flex-col items-center p-3 text-gray-600">
            <i data-feather="user" class="w-6 h-6"></i>
            <span class="text-xs mt-1">Profile</span>
        </a>
    </div>
</div>
