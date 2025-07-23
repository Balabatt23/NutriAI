<div class="flex">
    <!-- Desktop Sidebar -->
    <div class="hidden lg:flex flex-col w-64 bg-white h-screen shadow-lg sticky top-0">
        <!-- Atas (profile + nav) -->
        <div class="p-6 flex-1 flex flex-col">
            <div class="flex items-center space-x-3 mb-8">
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

            <nav class="space-y-2">
                <a href="/dashboard" class="flex items-center space-x-3 p-3 {{ $title === 'dashboard' ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                    <i data-feather="home" class="w-5 h-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="/history" class="flex items-center space-x-3 p-3 {{ $title === 'history' ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                    <i data-feather="calendar" class="w-5 h-5"></i>
                    <span>History</span>
                </a>
                <a href="/profile" class="flex items-center space-x-3 p-3 {{ $title === 'profile' ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:bg-gray-50' }} rounded-lg">
                    <i data-feather="user" class="w-5 h-5"></i>
                    <span>Profile</span>
                </a>
            </nav>
        </div>

        <!-- Logout paling bawah -->
        <div class="p-6 border-t">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i data-feather="log-out" class="w-5 h-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1">
        {{ $slot }}
    </div>
</div>
