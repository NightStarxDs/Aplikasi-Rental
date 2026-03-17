<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CDN Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Login
        </h1>

        <form>
            <!-- Username -->
            <div class="mb-4">
                <label class="block text-gray-600 mb-1">Username</label>
                <input 
                    type="text" 
                    placeholder="Masukkan username"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-600 mb-1">Password</label>
                <input 
                    type="password" 
                    placeholder="Masukkan password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200"
            >
                Login
            </button>
        </form>
    </div>

</body>
</html>