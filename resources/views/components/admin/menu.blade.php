<aside class="hidden lg:block bg-gray-700 text-white w-64 left-0 h-auto py-8 px-4 z-50">
    <h2 class="text-2xl font-semibold mb-6 border-b border-gray-600 pb-2">Admin Panel</h2>
    <ul class="space-y-2">
        <li><a href="/" class="'hover:bg-gray-700' block py-2 px-4 rounded">Home</a></li>

        <li><a href="/dashboard"
                class="{{ request()->is('dashboard') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-700' }} block py-2 px-4 rounded">Dashboard</a>
        </li>
        <li>
            <a href="/schedules"
                class="group {{ request()->is('schedules*') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-700' }} block py-2 px-4 rounded">
                Schedules
                <span class="group-hover:opacity-30 transition-opacity duration-200">
                    @if (request()->is('schedules/create'))
                        | Create
                    @elseif(request()->is('schedules/*/edit'))
                        | Edit
                    @elseif(request()->is('schedules/*'))
                        | Show
                    @endif
                </span>
            </a>
        </li>

        <li><a href="/telkominfra"
                class="group {{ request()->is('telkominfra*') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-700' }} block py-2 px-4 rounded">
                Telkominfra
                <span class="group-hover:opacity-30 transition-opacity duration-200">
                    @if (request()->is('telkominfra/*'))
                        | Show
                    @endif
                </span>
            </a></li>

        <li><a href="{{ route('profile.show') }}"
                class="{{ request()->is('user/profile') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-700' }} block py-2 px-4 rounded">{{ Auth::user()->name }}</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    {{ __('Logout') }}
                </button>
            </form>
        </li>
    </ul>
</aside>


<header class="fixed top-0 w-full z-50 lg:hidden lg:px-16 px-4 bg-gray-700 flex flex-wrap items-center py-4 shadow-md">
    <div class="flex-1 flex justify-between items-center">
        <a class="text-xl text-white">Admin Panel</a>
    </div>

    <label for="menu-toggle" id="menu-toggle-label" class="pointer-cursor lg:hidden block">
        <svg class="fill-current text-gray-100" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
    </label>
</header>

<div class="mb-[4rem] lg:mb-0"></div>

<div id="popup-menu"
    class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 justify-center items-center">
    <div class="bg-white rounded-bl-md rounded-br-md shadow-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Admin Panel</h2>
        <nav>
            <ul class="space-y-2">
                <li><a href="/" class="block py-2 px-4 hover:bg-gray-100 rounded">Home</a></li>
                <li><a href="/dashboard"
                        class="{{ request()->is('dashboard') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-100' }} block py-2 px-4 rounded">Dashboard</a>
                </li>
                <li><a href="/schedules"
                        class="group {{ request()->is('schedules*') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-100' }} block py-2 px-4 rounded">
                        Schedules
                        <span class="group-hover:opacity-30 transition-opacity duration-200">
                            @if (request()->is('schedules/create'))
                                | Create
                            @elseif(request()->is('schedules/*/edit'))
                                | Edit
                            @elseif(request()->is('schedules/*'))
                                | Show
                            @endif
                        </span>
                    </a></li>
                 <li><a href="/telkominfra"
                        class="group {{ request()->is('telkominfra*') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-100' }} block py-2 px-4 rounded">
                        Telkominfra
                        <span class="group-hover:opacity-30 transition-opacity duration-200">
                            @if (request()->is('telkominfra/*'))
                                | Show
                            @endif
                        </span>
                    </a></li>
                <li><a href="{{ route('profile.show') }}"
                        class="{{ request()->is('user/profile') ? 'bg-blue-500 text-white hover:bg-blue-600' : 'hover:bg-gray-100' }} block py-2 px-4 rounded">{{ Auth::user()->name }}</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" class="w-full text-left block py-2 px-4 hover:bg-gray-100 rounded">
                            {{ __('Logout') }}
                        </button>
                    </form>
                </li>
                <li>
                    <button id="close-popup"
                        class="block py-2 px-4 bg-gray-200 hover:bg-gray-300 rounded mt-4">Close</button>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    const menuToggleLabel = document.getElementById('menu-toggle-label');
    const popupMenu = document.getElementById('popup-menu');
    const closePopup = document.getElementById('close-popup');

    if (menuToggleLabel && popupMenu && closePopup) {
        menuToggleLabel.addEventListener('click', () => {
            popupMenu.classList.remove('hidden');
        });

        closePopup.addEventListener('click', () => {
            popupMenu.classList.add('hidden');
        });

        window.addEventListener('click', (event) => {
            if (event.target === popupMenu) {
                popupMenu.classList.add('hidden');
            }
        });
    }
</script>
