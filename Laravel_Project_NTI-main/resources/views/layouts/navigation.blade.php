<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:flex">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="text-white">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="text-white">
                        {{ __('Categories') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.jobs.index')" :active="request()->routeIs('admin.jobs.*')" class="text-white">
                        {{ __('Jobs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')" class="text-white">
                        {{ __('Users') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.applications.index')" :active="request()->routeIs('admin.applications.*')" class="text-white">
                        {{ __('Applications') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown (User Profile & Logout) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-gray-800 hover:text-white hover:bg-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white font-medium">Log in</a>
                @endauth
            </div>
        </div>
    </div>
</nav>