<nav x-data="{ open: false }" class="bg-white border-b-2 border-black">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">

                    @if (auth()->user()->role === 'employee')
                    <a href="{{ route('employee.dashboard') }}" class="flex items-center gap-2 font-black text-black">
                        @elseif (auth()->user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" class="flex items-center gap-2 font-black text-black">
                            @elseif (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 font-black text-black">
                                @endif

                                <x-application-logo class="block h-9 w-auto fill-current text-black" />

                                @if (auth()->user()->role === 'employee')
                            </a>
                            @elseif (auth()->user()->role === 'employer')
                        </a>
                        @elseif (auth()->user()->role === 'admin')
                    </a>
                    @endif

                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">

                    @if (auth()->user()->role === 'employee')

                    <x-nav-link
                        :href="route('employee.dashboard')"
                        :active="request()->routeIs('employee.dashboard')">
                        Dashboard
                    </x-nav-link>

                    @elseif (auth()->user()->role === 'employer')

                    <x-nav-link
                        :href="route('employer.dashboard')"
                        :active="request()->routeIs('employer.dashboard')">
                        Dashboard
                    </x-nav-link>

                    @elseif (auth()->user()->role === 'admin')

                    <x-nav-link
                        :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">
                        Dashboard
                    </x-nav-link>

                    @endif

                    <!-- Community -->
                    <x-nav-link
                        :href="route('posts.index')"
                        :active="request()->routeIs('posts.*')">
                        Community
                    </x-nav-link>

                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button class="inline-flex items-center px-4 py-2 bg-white border-2 border-black rounded-lg text-sm leading-4 font-bold text-black shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] focus:outline-none transition ease-in-out duration-150">

                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">

                                <svg class="fill-current h-4 w-4"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />

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

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">

                                {{ __('Log Out') }}

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Hamburger -->

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 bg-white border-2 border-black rounded-lg text-black shadow-[2px_2px_0px_0px_#000000] hover:translate-y-[-1px] hover:shadow-[3px_3px_0px_0px_#000000] focus:outline-none transition duration-150 ease-in-out">

                    <svg class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24">

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open }"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open }"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>
    </div>

    <!-- Responsive Navigation Menu -->

    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-[#F4F0EA] border-t-2 border-black">

        <div class="pt-2 pb-3 space-y-1 bg-white border-b-2 border-black px-2">

            @if (auth()->user()->role === 'employee')

            <x-responsive-nav-link
                :href="route('employee.dashboard')"
                :active="request()->routeIs('employee.dashboard')">

                Employee Dashboard

            </x-responsive-nav-link>

            @elseif (auth()->user()->role === 'employer')

            <x-responsive-nav-link
                :href="route('employer.dashboard')"
                :active="request()->routeIs('employer.dashboard')">

                Employer Dashboard

            </x-responsive-nav-link>

            @elseif (auth()->user()->role === 'admin')

            <x-responsive-nav-link
                :href="route('admin.dashboard')"
                :active="request()->routeIs('admin.dashboard')">

                Admin Dashboard

            </x-responsive-nav-link>

            @endif

            <x-responsive-nav-link
                :href="route('posts.index')"
                :active="request()->routeIs('posts.*')">

                Community

            </x-responsive-nav-link>

        </div>

        <!-- Responsive Settings Options -->

        <div class="pt-4 pb-1 border-t-2 border-black bg-[#EFECE6]">

            <div class="px-4">

                <div class="font-bold text-base text-black">
                    {{ Auth::user()->name }}
                </div>

                <div class="font-semibold text-sm text-slate-600">
                    {{ Auth::user()->email }}
                </div>

            </div>

            <div class="mt-3 space-y-1 bg-white border-y-2 border-black">

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->

                <form method="POST" action="{{ route('logout') }}">

                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">

                        {{ __('Log Out') }}

                    </x-responsive-nav-link>

                </form>

            </div>

        </div>

    </div>

</nav>
