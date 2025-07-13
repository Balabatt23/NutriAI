<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - NutriAI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-hover:active {
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-lg p-8 text-center">
            <!-- Logo -->
            <div class="mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <span class="text-white font-bold text-xl">NA</span>
                </div>
                <h2 class="text-xl font-semibold text-gray-900">Verify Your Email</h2>
                <p class="text-gray-600 mt-2">
                    We've sent a verification link to your email. <br>
                    Please check your inbox before continuing.
                </p>
            </div>

            <!-- Resend Form -->
            <form method="POST" action="/verify">
                @csrf
                <input type="hidden" value="register" name="type">
                <button 
                    type="submit"
                    class="btn-hover w-full bg-emerald-500 hover:bg-emerald-600 text-white font-semibold py-3 px-6 rounded-2xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                >
                    Send OTP to your Email
                </button>
            </form>

            <!-- Logout Option -->
            <form method="GET" action="/logout" class="mt-4">
                @csrf
                <button 
                    type="submit"
                    class="w-full text-gray-600 hover:text-gray-800 text-sm mt-2 font-medium"
                >
                    Log out
                </button>
            </form>

            <!-- Optional: Success Message -->
            @if (session('status') === 'verification-link-sent')
                <div class="mt-4 text-sm text-green-600 font-medium">
                    A new verification link has been sent to your email!
                </div>
            @endif
        </div>
    </div>
</body>
</html>
