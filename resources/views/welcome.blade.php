<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Jungle</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-green-900 text-white font-sans">

    <!-- Container -->
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://your-image-url-here');">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <!-- Content -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-7xl font-bold text-yellow-400 mb-6">Welcome to the Jungle!</h1>

        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-green-900 py-6 text-center text-white">
        <p>&copy; 2025 Welcome to the Jungle. All rights reserved.</p>
    </footer>

</body>

</html>
