@props(['title'])

@php 
    $user = Auth::user();
@endphp

<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>title</title>
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
        <x-mobile-navbar :user="$user">

            <x-desktop-sidebar :user="$user" title="{{ $title }}">
                {{ $slot }}
            </x-desktop-sidebar>

        </x-mobile-navbar>
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
    @stack('scripts')
</body>
</html>