<header class="bg-white shadow-md fixed top-0 w-full z-20">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
        <!-- Logo -->
        @php
            $role = Auth::user()->role ?? 'guest';
            $dashboardRoute = match ($role) {
                'admin' => 'admin.dashboard',
                'user' => 'getDashboard',

                default => 'getDashboard',
            };
        @endphp

        <a href="{{ route($dashboardRoute) }}" class="text-2xl font-bold text-blue-600">
            LaraBlog
        </a>


        <!-- Right Section -->
        <div class="flex items-center space-x-6">
            <!-- Logged in User -->
            <span class="text-gray-700 font-medium">
                Hello, <span class="text-blue-600">{{ Auth::user()->getFirstname() }}</span>
            </span>


            <!-- Logout -->
            <a href="{{ route('postLogout') }}"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                Logout
            </a>
        </div>
    </div>
</header>
