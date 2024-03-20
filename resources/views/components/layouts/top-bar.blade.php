<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">
        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                @if(auth()->user())
                    <div x-data="{ isOpen: false }" @click.away="isOpen = false" class="relative">
                        <button @click="isOpen = !isOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150 font-bold">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>

                        <div x-show="isOpen" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                            <div class="py-1" role="none">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Profile</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
                @if (Route::has('login'))
                    @auth
                    @else
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('login') }}">Log in</a>
                        </li>
                        @if (Route::has('register'))
                            <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
                <li><a class="hover:text-gray-200 hover:underline px-4" href="{{route('home')}}">Home</a></li>
                <li><a class="hover:text-gray-200 hover:underline px-4" href="{{route('about')}}">About</a></li>
            </ul>
        </nav>

        <div class="flex items-center text-lg no-underline text-white pr-6">
            <a class="" href="https://www.facebook.com/mohammed.aljaoor?mibextid=ZbWKwL">
                <i class="fab fa-facebook"></i>
            </a>
            <a class="pl-6" href="https://www.instagram.com/mohammed_aljaoor?igsh=MTc4NTV0ODJ2bXE2bw==">
                <i class="fab fa-instagram"></i>
            </a>
            <a class="pl-6" href="mailto:mohammed.aljaoor6@gmail.com">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>

</nav>
