<nav class="sticky top-0 z-10 border-b border-gray-100 bg-white dark:border-gray-700 dark:bg-gray-800" x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @can('viewAny', \App\Models\Profile::class)
                        <x-nav-link :active="request()->routeIs('profile')" href="{{ route('profile') }}">
                            {{ __('Profile') }}
                        </x-nav-link>
                    @endcan
                    @can('qrCode', auth()->user()->profile)
                        <x-nav-link :active="request()->routeIs('qr_code')" href="{{ route('qr_code') }}">
                            {{ __('QR Code') }}
                        </x-nav-link>
                    @endcan
                    @can('viewPartners', auth()->user())
                        <x-nav-link :active="request()->routeIs('partners.*')" href="{{ route('partners.index') }}">
                            {{ __('Partners') }}
                        </x-nav-link>
                    @endcan
                    @can('viewAny', \App\Models\Product::class)
                        <x-nav-link :active="request()->routeIs('products.*')" href="{{ route('products.index') }}">
                            {{ __('Products') }}
                        </x-nav-link>
                    @endcan
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="relative ml-3">
                        <x-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700" type="button">
                                        {{ Auth::user()->currentTeam->name }}

                                        <i class="bi bi-chevron-expand ml-2 text-sm"></i>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-dropdown-link>
                                    @endcan

                                    <!-- Team Switcher -->
                                    @if (Auth::user()->allTeams()->count() > 1)
                                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Switch Teams') }}
                                        </div>

                                        @foreach (Auth::user()->allTeams() as $team)
                                            <x-switchable-team :team="$team" />
                                        @endforeach
                                    @endif
                                </div>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="flex items-center justify-between gap-3">
                    <livewire:auth.components.product-box-link />

                    <x-nav-link class="relative border-none" href="{{ route('notifications.index') }}">
                        <i class="bi bi-bell text-xl"></i>
                        <span class="sr-only">Notifications</span>
                        <livewire:auth.components.notifications-count />
                    </x-nav-link>

                    <x-nav-link class="relative cursor-pointer border-none" x-cloak x-on:click.prevent="dark = !dark">
                        <i class="bi bi-brightness-high text-xl" x-show="dark"></i>
                        <i class="bi bi-moon text-xl" x-show="!dark"></i>
                    </x-nav-link>
                </div>

                <div class="relative ml-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex rounded-full border-2 border-transparent text-sm transition focus:border-gray-300 focus:outline-none">
                                    <img alt="{{ auth()->user()->profile->name ?? auth()->user()->name }}" class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button class="inline-flex items-center rounded-md border border-gray-200 bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:text-gray-300 dark:focus:bg-gray-700 dark:active:bg-gray-700" type="button">
                                        {{ auth()->user()->profile->name ?? auth()->user()->name }}
                                        <i class="bi bi-chevron-down ml-2 text-sm"></i>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Account') }}
                            </x-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-dropdown-link>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form action="{{ route('logout') }}" method="POST" x-data>
                                @csrf

                                <x-dropdown-link @click.prevent="$root.submit();" href="{{ route('logout') }}">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden" x-cloak>
                <button class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400" type="button" x-on:click="dark = !dark">
                    <i class="bi bi-brightness-high text-xl" x-show="dark"></i>
                    <i class="bi bi-moon text-xl" x-show="!dark"></i>
                </button>
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400" type="button">
                    <i class="bi bi-list text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div class="block" x-cloak x-collapse x-show="open" x-transition.duration.500ms>
        <div class="space-y-1 pb-3 pt-2">
            <x-responsive-nav-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @can('viewAny', \App\Models\Profile::class)
                <x-responsive-nav-link :active="request()->routeIs('profile')" href="{{ route('profile') }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
            @endcan
            @can('qrCode', auth()->user()->profile)
                <x-responsive-nav-link :active="request()->routeIs('qr_code')" href="{{ route('qr_code') }}">
                    {{ __('QR Code') }}
                </x-responsive-nav-link>
            @endcan

            @can('viewPartners', auth()->user())
                <x-responsive-nav-link :active="request()->routeIs('partners.*')" href="{{ route('partners.index') }}">
                    {{ __('Partners') }}
                </x-responsive-nav-link>
            @endcan

            <x-responsive-nav-link :active="request()->routeIs('notifications')" href="{{ route('notifications.index') }}">
                {{ __('Notifications') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="mr-3 shrink-0">
                        <img alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link :active="request()->routeIs('profile.show')" href="{{ route('profile.show') }}">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link :active="request()->routeIs('api-tokens.index')" href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form action="{{ route('logout') }}" method="POST" x-data>
                    @csrf

                    <x-responsive-nav-link @click.prevent="$root.submit();" :navigate="false" href="{{ route('logout') }}">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link :active="request()->routeIs('teams.show')" href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link :active="request()->routeIs('teams.create')" href="{{ route('teams.create') }}">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
