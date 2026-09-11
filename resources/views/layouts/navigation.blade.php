<nav
    x-data="{ open: false }"
    class="nav-bar"
>
    <div class="nav-container">

        <div class="nav-inner">

            {{-- ============================ --}}
            {{-- Left: Logo + Desktop Links --}}
            {{-- ============================ --}}
            <div class="nav-left">

                {{-- Logo --}}
                <div class="nav-logo-wrapper">

                    @if (auth()->user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="nav-logo-link">
                    @elseif (auth()->user()->role === 'employer')
                        <a href="{{ route('employer.dashboard') }}" class="nav-logo-link">
                    @elseif (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="nav-logo-link">
                    @endif

                        <x-application-logo
                            class="nav-logo-icon"
                        />

                    @if (
                        auth()->user()->role === 'employee' ||
                        auth()->user()->role === 'employer' ||
                        auth()->user()->role === 'admin'
                    )
                        </a>
                    @endif

                </div>


                {{-- Desktop Navigation --}}
                <div class="nav-links">

                    @if (auth()->user()->role === 'employee')

                        <x-nav-link
                            :href="route('employee.dashboard')"
                            :active="request()->routeIs('employee.dashboard')"
                            class="nav-link"
                        >
                            Dashboard
                        </x-nav-link>

                    @elseif (auth()->user()->role === 'employer')

                        <x-nav-link
                            :href="route('employer.dashboard')"
                            :active="request()->routeIs('employer.dashboard')"
                            class="nav-link"
                        >
                            Dashboard
                        </x-nav-link>

                    @elseif (auth()->user()->role === 'admin')

                        <x-nav-link
                            :href="route('admin.dashboard')"
                            :active="request()->routeIs('admin.dashboard')"
                            class="nav-link"
                        >
                            Dashboard
                        </x-nav-link>

                    @endif


                    {{-- Posts --}}
                    <x-nav-link
                        :href="url('/posts')"
                        :active="request()->is('posts*')"
                        class="nav-link"
                    >
                        Posts
                    </x-nav-link>

                </div>

            </div>


            {{-- ============================ --}}
            {{-- Right: User Dropdown (Desktop) --}}
            {{-- ============================ --}}
            <div class="nav-right">

                <x-dropdown align="right" width="56">

                    <x-slot name="trigger">

                        <button class="nav-user-trigger">

                            {{-- Avatar --}}
                            <div class="nav-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            {{-- Name --}}
                            <div class="nav-user-info">
                                <div class="nav-user-name">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="nav-user-role">
                                    {{ ucfirst(Auth::user()->role) }}
                                </div>
                            </div>

                            {{-- Chevron --}}
                            <svg
                                class="nav-chevron"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>

                        </button>

                    </x-slot>


                    <x-slot name="content">

                        <div class="nav-dropdown-header">

                            <div class="nav-dropdown-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div class="nav-dropdown-info">
                                <div class="nav-dropdown-name">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="nav-dropdown-email">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                        </div>

                        <div class="nav-dropdown-divider"></div>

                        <x-dropdown-link :href="route('profile.edit')" class="nav-dropdown-link">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                class="nav-dropdown-link nav-dropdown-link-danger"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            >
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>


            {{-- ============================ --}}
            {{-- Mobile Menu Button --}}
            {{-- ============================ --}}
            <div class="nav-mobile-toggle">

                <button
                    @click="open = ! open"
                    class="nav-mobile-button"
                    aria-label="Toggle menu"
                >

                    {{-- Hamburger --}}
                    <svg
                        :class="{'nav-hidden': open, 'nav-visible': !open}"
                        class="nav-icon"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    {{-- Close --}}
                    <svg
                        :class="{'nav-hidden': !open, 'nav-visible': open}"
                        class="nav-icon nav-hidden"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- ============================ --}}
    {{-- Mobile Navigation Panel --}}
    {{-- ============================ --}}
    <div
        x-show="open"
        x-transition:enter="nav-mobile-enter"
        x-transition:enter-start="nav-mobile-enter-start"
        x-transition:enter-end="nav-mobile-enter-end"
        x-transition:leave="nav-mobile-leave"
        x-transition:leave-start="nav-mobile-leave-start"
        x-transition:leave-end="nav-mobile-leave-end"
        class="nav-mobile-panel"
        style="display: none;"
    >

        <div class="nav-mobile-links">

            @if (auth()->user()->role === 'employee')

                <x-responsive-nav-link
                    :href="route('employee.dashboard')"
                    :active="request()->routeIs('employee.dashboard')"
                    class="nav-mobile-link"
                >
                    Dashboard
                </x-responsive-nav-link>

            @elseif (auth()->user()->role === 'employer')

                <x-responsive-nav-link
                    :href="route('employer.dashboard')"
                    :active="request()->routeIs('employer.dashboard')"
                    class="nav-mobile-link"
                >
                    Dashboard
                </x-responsive-nav-link>

            @elseif (auth()->user()->role === 'admin')

                <x-responsive-nav-link
                    :href="route('admin.dashboard')"
                    :active="request()->routeIs('admin.dashboard')"
                    class="nav-mobile-link"
                >
                    Dashboard
                </x-responsive-nav-link>

            @endif


            <x-responsive-nav-link
                :href="url('/posts')"
                :active="request()->is('posts*')"
                class="nav-mobile-link"
            >
                Posts
            </x-responsive-nav-link>

        </div>


        {{-- Mobile User Section --}}
        <div class="nav-mobile-user">

            <div class="nav-mobile-user-header">

                <div class="nav-mobile-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <div class="nav-mobile-user-info">
                    <div class="nav-mobile-user-name">
                        {{ Auth::user()->name }}
                    </div>
                    <div class="nav-mobile-user-email">
                        {{ Auth::user()->email }}
                    </div>
                </div>

            </div>


            <div class="nav-mobile-user-links">

                <x-responsive-nav-link
                    :href="route('profile.edit')"
                    class="nav-mobile-link"
                >
                    {{ __('Profile') }}
                </x-responsive-nav-link>


                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link
                        :href="route('logout')"
                        class="nav-mobile-link nav-mobile-link-danger"
                        onclick="event.preventDefault();
                            this.closest('form').submit();"
                    >
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>

        </div>

    </div>

</nav>


{{-- ============================================ --}}
{{-- Navigation Styles (scoped via nav-bar prefix) --}}
{{-- ============================================ --}}
<style>
    /* =========================
       Base
    ========================= */
    .nav-bar {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        position: sticky;
        top: 0;
        z-index: 50;
        font-family: "Figtree", "Inter", Arial, sans-serif;
    }

    .nav-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }

    .nav-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 64px;
        gap: 24px;
    }

    /* =========================
       Left Section
    ========================= */
    .nav-left {
        display: flex;
        align-items: center;
        gap: 36px;
        min-width: 0;
    }

    .nav-logo-wrapper {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .nav-logo-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: opacity 0.2s ease;
    }

    .nav-logo-link:hover {
        opacity: 0.85;
    }

    .nav-logo-icon {
        display: block;
        height: 34px;
        width: auto;
        color: #0f172a;
        fill: currentColor;
    }

    /* =========================
       Desktop Links
    ========================= */
    .nav-links {
        display: none;
        align-items: center;
        gap: 4px;
    }

    /* Override x-nav-link default styles */
    .nav-links .nav-link,
    .nav-links a.nav-link {
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        line-height: 1;
    }

    .nav-links .nav-link:hover {
        color: #2563eb;
        background: #eff6ff;
    }

    .nav-links .nav-link.active,
    .nav-links .nav-link[aria-current="page"] {
        color: #2563eb;
        background: #eff6ff;
    }

    /* =========================
       Right Section
    ========================= */
    .nav-right {
        display: none;
        align-items: center;
    }

    /* =========================
       User Trigger
    ========================= */
    .nav-user-trigger {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 6px 10px 6px 6px;
        border-radius: 999px;
        background: transparent;
        border: 1px solid transparent;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .nav-user-trigger:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    .nav-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 2px 6px rgba(37, 99, 235, 0.25);
    }

    .nav-user-info {
        display: none;
        text-align: left;
        line-height: 1.2;
    }

    .nav-user-name {
        font-size: 13px;
        font-weight: 700;
        color: #0f172a;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-user-role {
        font-size: 11px;
        font-weight: 500;
        color: #64748b;
        text-transform: capitalize;
    }

    .nav-chevron {
        width: 14px;
        height: 14px;
        color: #94a3b8;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }

    .nav-user-trigger:hover .nav-chevron {
        color: #2563eb;
    }

    /* =========================
       Dropdown Content
    ========================= */
    .nav-dropdown-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
    }

    .nav-dropdown-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-dropdown-info {
        min-width: 0;
        line-height: 1.3;
    }

    .nav-dropdown-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-dropdown-email {
        font-size: 12px;
        color: #64748b;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-dropdown-divider {
        height: 1px;
        background: #f1f5f9;
        margin: 4px 0;
    }

    .nav-dropdown-link {
        display: block !important;
        padding: 10px 16px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        text-decoration: none !important;
        transition: all 0.15s ease !important;
        border-radius: 0 !important;
        line-height: 1.3 !important;
    }

    .nav-dropdown-link:hover {
        background: #f8fafc !important;
        color: #2563eb !important;
    }

    .nav-dropdown-link-danger {
        color: #dc2626 !important;
    }

    .nav-dropdown-link-danger:hover {
        background: #fef2f2 !important;
        color: #b91c1c !important;
    }

    /* =========================
       Mobile Toggle
    ========================= */
    .nav-mobile-toggle {
        display: flex;
        align-items: center;
    }

    .nav-mobile-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: transparent;
        border: 1px solid transparent;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .nav-mobile-button:hover {
        background: #f1f5f9;
        color: #2563eb;
        border-color: #e2e8f0;
    }

    .nav-icon {
        width: 22px;
        height: 22px;
    }

    .nav-hidden {
        display: none !important;
    }

    .nav-visible {
        display: inline-flex !important;
    }

    /* =========================
       Mobile Panel
    ========================= */
    .nav-mobile-panel {
        border-top: 1px solid #e2e8f0;
        background: #ffffff;
    }

    .nav-mobile-links {
        padding: 12px 16px 8px;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .nav-mobile-link {
        display: block !important;
        padding: 11px 14px !important;
        border-radius: 8px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        text-decoration: none !important;
        transition: all 0.15s ease !important;
        line-height: 1.2 !important;
    }

    .nav-mobile-link:hover {
        background: #eff6ff !important;
        color: #2563eb !important;
    }

    .nav-mobile-link.active,
    .nav-mobile-link[aria-current="page"] {
        background: #eff6ff !important;
        color: #2563eb !important;
    }

    .nav-mobile-link-danger {
        color: #dc2626 !important;
    }

    .nav-mobile-link-danger:hover {
        background: #fef2f2 !important;
        color: #b91c1c !important;
    }

    /* =========================
       Mobile User Section
    ========================= */
    .nav-mobile-user {
        border-top: 1px solid #e2e8f0;
        padding: 16px;
    }

    .nav-mobile-user-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .nav-mobile-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .nav-mobile-user-info {
        min-width: 0;
        line-height: 1.3;
    }

    .nav-mobile-user-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-mobile-user-email {
        font-size: 12px;
        color: #64748b;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .nav-mobile-user-links {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    /* =========================
       Alpine Transitions
    ========================= */
    .nav-mobile-enter {
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .nav-mobile-enter-start {
        opacity: 0;
        transform: translateY(-8px);
    }

    .nav-mobile-enter-end {
        opacity: 1;
        transform: translateY(0);
    }

    .nav-mobile-leave {
        transition: opacity 0.15s ease, transform 0.15s ease;
    }

    .nav-mobile-leave-start {
        opacity: 1;
        transform: translateY(0);
    }

    .nav-mobile-leave-end {
        opacity: 0;
        transform: translateY(-8px);
    }

    /* =========================
       Dark Mode
    ========================= */
    @media (prefers-color-scheme: dark) {
        .nav-bar {
            background: #0f172a;
            border-bottom-color: #1e293b;
        }

        .nav-logo-icon {
            color: #f1f5f9;
        }

        .nav-links .nav-link {
            color: #cbd5e1;
        }

        .nav-links .nav-link:hover,
        .nav-links .nav-link.active {
            color: #60a5fa;
            background: rgba(37, 99, 235, 0.15);
        }

        .nav-user-trigger:hover {
            background: #1e293b;
            border-color: #334155;
        }

        .nav-user-name {
            color: #f1f5f9;
        }

        .nav-user-role {
            color: #94a3b8;
        }

        .nav-mobile-panel {
            background: #0f172a;
            border-top-color: #1e293b;
        }

        .nav-mobile-link {
            color: #cbd5e1 !important;
        }

        .nav-mobile-link:hover,
        .nav-mobile-link.active {
            background: rgba(37, 99, 235, 0.15) !important;
            color: #60a5fa !important;
        }

        .nav-mobile-user {
            border-top-color: #1e293b;
        }

        .nav-mobile-user-name {
            color: #f1f5f9;
        }

        .nav-mobile-user-email {
            color: #94a3b8;
        }

        .nav-mobile-button {
            color: #cbd5e1;
        }

        .nav-mobile-button:hover {
            background: #1e293b;
            color: #60a5fa;
            border-color: #334155;
        }

        .nav-dropdown-name {
            color: #f1f5f9;
        }

        .nav-dropdown-email {
            color: #94a3b8;
        }

        .nav-dropdown-link {
            color: #cbd5e1 !important;
        }

        .nav-dropdown-link:hover {
            background: #1e293b !important;
            color: #60a5fa !important;
        }

        .nav-dropdown-link-danger {
            color: #f87171 !important;
        }

        .nav-dropdown-link-danger:hover {
            background: rgba(220, 38, 38, 0.15) !important;
            color: #fca5a5 !important;
        }
    }

    /* =========================
       Responsive
    ========================= */
    @media (min-width: 640px) {
        .nav-links {
            display: flex;
        }

        .nav-right {
            display: flex;
        }

        .nav-mobile-toggle {
            display: none;
        }

        .nav-user-info {
            display: block;
        }
    }

    @media (max-width: 639px) {
        .nav-container {
            padding: 0 16px;
        }

        .nav-inner {
            height: 60px;
        }

        .nav-logo-icon {
            height: 30px;
        }
    }
</style>