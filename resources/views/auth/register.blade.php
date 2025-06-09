<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SPYNA</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen font-[Montserrat] text-white bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('/storage/images/login.png') }}')">
    <div class="absolute top-0 w-full flex justify-between items-center p-5 z-50">
        <div class="flex items-center gap-5">
            <div class="text-2xl font-extrabold flex items-center">
                <img src="{{ asset('storage/images/Vector.png') }}" alt="Logo" class="h-12 mr-2" /> SPYNA
            </div>
            <div class="flex items-center gap-4 border border-white rounded-full px-5 py-1 text-sm">
                <a href="#" class="text-white">Home</a>
                <span class="text-white">-</span>
                <a href="#" class="text-white">About</a>
                <span class="text-white">-</span>
                <a href="#" class="text-white">Contact</a>
            </div>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="text-white border border-white px-4 py-1 rounded-full">Sign In</a>
            <a href="{{ route('register') }}" class="text-white bg-black/90 px-4 py-1 rounded-full">Sign Up</a>
        </div>
    </div>

    <div class="flex items-center justify-center min-h-screen pt-20">
        <div class="bg-black/70 rounded-xl p-10 w-[400px] flex flex-col gap-4 items-center">
            <h2 class="text-2xl font-bold mb-4">Sign Up</h2>
            <input type="text" placeholder="Full Name" class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm" />
            <input type="email" placeholder="Email" class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm" />
            <input type="password" placeholder="Password" class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm" />
            <input type="password" placeholder="Confirm Password" class="w-full px-4 py-2 rounded-lg text-black bg-gray-100 text-sm" />
            <button class="w-full bg-orange-500 text-white font-bold py-2 rounded-lg">Sign Up</button>
            <p class="text-xs mt-2">Already have an account? <a href="{{ route('login') }}" class="text-orange-500 font-bold">Sign In</a></p>
        </div>
    </div>
</body>
</html>
