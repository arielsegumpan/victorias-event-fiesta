<div>
    <!-- ========== HEADER ========== -->
    <header
        class="z-50 flex flex-wrap w-full bg-white border-b border-gray-200 md:justify-start md:flex-nowrap dark:bg-neutral-800 dark:border-neutral-700">
        <nav
            class="relative max-w-[85rem] w-full mx-auto md:flex md:items-center md:justify-between md:gap-3 py-2 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-x-1">
                <a class="flex-none text-xl font-semibold text-black focus:outline-hidden focus:opacity-80 dark:text-white"
                    href="{{ route('home.page') }}" aria-label="{{ config('app.name') }}">
                    <img src="{{ asset('imgs/vfs.png') }}" class="h-auto w-14" alt="{{ config('app.name') }}">
                </a>

                <!-- Collapse Button -->
                <button type="button"
                    class="relative flex items-center justify-center text-sm font-medium text-gray-800 border border-gray-200 rounded-md hs-collapse-toggle md:hidden size-9 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                    id="hs-header-base-collapse" aria-expanded="false" aria-controls="hs-header-base"
                    aria-label="Toggle navigation" data-hs-collapse="#hs-header-base">
                    <svg class="hs-collapse-open:hidden size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" x2="21" y1="6" y2="6" />
                        <line x1="3" x2="21" y1="12" y2="12" />
                        <line x1="3" x2="21" y1="18" y2="18" />
                    </svg>
                    <svg class="hidden hs-collapse-open:block shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <!-- End Collapse Button -->
            </div>

            <!-- Collapse -->
            <div id="hs-header-base"
                class="hidden overflow-hidden transition-all duration-300 hs-collapse basis-full grow md:block "
                aria-labelledby="hs-header-base-collapse">
                <div
                    class="overflow-hidden overflow-y-auto max-h-[75vh] [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-md [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                    <div class="py-2 md:py-0  flex flex-col md:flex-row md:items-center gap-0.5 md:gap-1">
                        <div class="grow">
                            <div
                                class="flex flex-col md:flex-row md:justify-end md:items-center gap-0.5 md:gap-1 md:gap-x-5">
                                <a class="p-2 flex items-center text-sm rounded-md focus:outline-hidden
                        {{ request()->routeIs('home.page') ? 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200' : 'text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
                                    href="{{ route('home.page') }}" aria-current="page">
                                    {{ __('Home') }}
                                </a>

                                <a class="p-2 flex items-center text-sm rounded-md focus:outline-hidden
                        {{ request()->routeIs('barangays.page') || request()->routeIs('barangay-single.page') ? 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200' : 'text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
                                    href="{{ route('barangays.page') }}">
                                    {{ __('Barangays') }}
                                </a>

                                <a class="p-2 flex items-center text-sm rounded-md focus:outline-hidden
                        {{ request()->routeIs('fiesta-eventos.page') || request()->routeIs('fiesta-eventos-single.page') ? 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200' : 'text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
                                    href="{{ route('fiesta-eventos.page') }}">
                                    {{ __('Fiesta & Eventos') }}
                                </a>

                                <a class="p-2 flex items-center text-sm rounded-md focus:outline-hidden
                        {{ request()->routeIs('about.page') ? 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200' : 'text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
                                    href="{{ route('about.page') }}">
                                    {{ __('About') }}
                                </a>

                                <a class="p-2 flex items-center text-sm rounded-md focus:outline-hidden
                        {{ request()->routeIs('contact.page') ? 'bg-gray-100 text-gray-800 dark:bg-neutral-700 dark:text-neutral-200' : 'text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-700' }}"
                                    href="{{ route('contact.page') }}">
                                    {{ __('Contact') }}
                                </a>

                            </div>
                        </div>

                        <div class="my-2 md:my-0 md:mx-2">
                            <div class="w-full h-px bg-gray-100 md:w-px md:h-4 md:bg-gray-300 dark:bg-neutral-700">
                            </div>
                        </div>

                        <button type="button"
                            class="block font-medium text-gray-800 rounded-md hs-dark-mode-active:hidden hs-dark-mode hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            data-hs-theme-click-value="dark">
                            <span class="inline-flex items-center justify-center group shrink-0 size-9">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                                </svg>
                            </span>
                        </button>
                        <button type="button"
                            class="hidden font-medium text-gray-800 rounded-md hs-dark-mode-active:block hs-dark-mode hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 dark:text-neutral-200 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                            data-hs-theme-click-value="light">
                            <span class="inline-flex items-center justify-center group shrink-0 size-9">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path d="M12 2v2"></path>
                                    <path d="M12 20v2"></path>
                                    <path d="m4.93 4.93 1.41 1.41"></path>
                                    <path d="m17.66 17.66 1.41 1.41"></path>
                                    <path d="M2 12h2"></path>
                                    <path d="M20 12h2"></path>
                                    <path d="m6.34 17.66-1.41 1.41"></path>
                                    <path d="m19.07 4.93-1.41 1.41"></path>
                                </svg>
                            </span>
                        </button>

                        @guest
                        <!-- Button Group -->
                        <div class=" flex flex-wrap items-center gap-x-1.5">
                            <a class="py-[7px] px-2.5 inline-flex items-center font-medium text-sm rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 focus:outline-hidden focus:bg-gray-100 dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                                href="{{ route('filament.auth.auth.login') }}">
                                {{ __('Sign in') }}
                            </a>
                            @if (Route::has('filament.auth.auth.register'))
                            <a class="py-2 px-2.5 inline-flex items-center font-medium text-sm rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:bg-orange-600"
                                href="{{ route('filament.auth.auth.register') }}">
                                {{ __('Get started') }}
                            </a>
                            @endif
                        </div>
                        <!-- End Button Group -->
                        @endguest

                        @auth
                        @hasrole('victoriasanon')
                        <div class="relative inline-flex hs-dropdown" data-hs-dropdown-placement="bottom-right">
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 transition duration-150 ease-in-out border border-transparent rounded-md bg-orange-600 text-white hover:bg-orange-700 focus:outline-hidden focus:bg-orange-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-orange-500 dark:hover:bg-orange-600 dark:focus:bg-orange-600">
                                    {{ Str::before(Auth::user()->name, ' ') }}

                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>


                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 z-10 bg-white shadow-md rounded-lg p-2 dark:bg-neutral-800 dark:border dark:border-neutral-700"
                                aria-labelledby="hs-dropdown-with-header">
                                <div class="px-5 py-3 -m-2 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                                    <p class="text-sm text-gray-500 dark:text-neutral-400">{{ __('Manage Menu') }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-800 dark:text-neutral-300">
                                        {{ Auth::user()->email }}</p>
                                </div>
                                <div class="py-2 mt-2 first:pt-0 last:pb-0">
{{--
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-orange-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                        href="#!">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                            <circle cx="9" cy="7" r="4" />
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        </svg>
                                        {{ __('Profile') }}
                                    </a> --}}
                                    <div>
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}" x-data>
                                            @csrf
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-orange-500 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300"
                                                href="#" @click.prevent="$root.submit();">
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                                </svg>
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endhasrole

                        @endauth
                    </div>
                </div>
            </div>
            <!-- End Collapse -->
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->
</div>
