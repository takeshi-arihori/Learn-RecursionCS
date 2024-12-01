<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beginner</title>
    <link rel="stylesheet" href="../output.css">
</head>

<body class="bg-gray-100 text-gray-800">
    <!-- Sidebar / Hamburger Menu -->
    <div class="pc:flex">
        <!-- Sidebar -->
        <div id="sidebar" class="hidden pc:block pc:w-64 bg-blue-700 text-white h-screen fixed inset-y-0 left-0 z-50">
            <!-- Sidebar Header with Hamburger -->
            <div class="flex justify-between items-center p-4">
                <h2 class="text-xl font-bold">Menu</h2>
                <button id="close-sidebar" class="p-2 text-white focus:outline-none hover:bg-blue-600 pc:hidden">
                    ☰
                </button>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="flex flex-col space-y-4 mt-4 px-4">
                <a href="/beginner" class="hover:text-gray-300">Beginner</a>
                <a href="/intermediate" class="hover:text-gray-300">Intermediate</a>
                <a href="/advanced" class="hover:text-gray-300">Advanced</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 pc:ml-64">
            <!-- Header with Hamburger Menu Icon -->

            <header class="w-full bg-blue-600 text-white p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <button id="open-sidebar" class="mr-4 block pc:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold"></h1>
                </div>
            </header>

            <!-- Main Section -->
            <main class="container mx-auto mt-8 h-[calc(100vh-30px)]">
                test
            </main>

            <!-- Footer -->
            <footer class="text-center mt-12">
                <a href="/" class="inline-block bg-blue-500 text-white text-lg font-medium py-2 px-4 rounded hover:bg-blue-600 transition">
                    ← Back to Home
                </a>
            </footer>
        </div>
    </div>

    <!-- JavaScript for Sidebar -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const openSidebarButton = document.getElementById('open-sidebar');
        const closeSidebarButton = document.getElementById('close-sidebar');

        // Function to open sidebar
        function openSidebar() {
            // Create backdrop
            const backdrop = document.createElement('div');
            backdrop.id = 'sidebar-backdrop';
            backdrop.classList.add('fixed', 'inset-0', 'bg-black', 'bg-opacity-50', 'z-40');
            backdrop.addEventListener('click', closeSidebar);
            document.body.appendChild(backdrop);

            // Show sidebar
            sidebar.classList.remove('hidden');
            sidebar.classList.add('fixed', 'inset-y-0', 'left-0', 'w-64', 'bg-blue-700', 'z-50', 'transform', 'transition-transform', 'duration-300', 'ease-in-out');
        }

        // Function to close sidebar
        function closeSidebar() {
            // Remove backdrop
            const backdrop = document.getElementById('sidebar-backdrop');
            if (backdrop) {
                backdrop.remove();
            }

            // Hide sidebar
            sidebar.classList.add('hidden');
            sidebar.classList.remove('fixed', 'inset-y-0', 'left-0', 'w-64', 'bg-blue-700', 'z-50', 'transform', 'transition-transform', 'duration-300', 'ease-in-out');
        }

        // Add event listeners
        openSidebarButton.addEventListener('click', openSidebar);
        closeSidebarButton.addEventListener('click', closeSidebar);
    </script>
</body>

</html>