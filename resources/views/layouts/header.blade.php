<style>
    .select2-container {
        position: absolute;
        right: 94px;
        width: 200px!important;
        top: 10px;
        height: 30px;
    }
    .select2-selection .select2-selection--multiple{
        height: 30px;
    }
</style>
<header class='w-full'>
    @if (Session::has('message'))
        <div class="flex items-center bg-green-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ Session::get('message') }}.</p>
        </div>
    @elseif (Session::has('error'))
        {
        <div class="flex items-center bg-red-500 text-white text-sm font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ Session::get('error') }}.</p>
        </div>
        }
    @endif
    <!-- Top Bar Nav -->
    <nav class="w-full  bg-blue-800 shadow" x-data="{ open: false }">
        <div class="w-full container mx-auto flex items-center justify-between">

            <div class="hidden lg:flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="{{ $setting->url_fb }}">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_insta }}">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_twitter }}">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_linkedin }}">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
            <!-- Topic Nav -->
            <nav class=" md:w-full" :class="open ? 'w-full' : 'w-3/12'">
                <div class="block md:hidden">
                    <a href="#"
                        class="md:hidden text-base font-bold max-md:text-white uppercase max-md:px-3 text-center flex justify-start md:justify-center items-center"
                        @click="open = !open">
                        {{ __('app.blogs.topics.topics') }} <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'"
                            class="fas ml-2"></i>
                    </a>
                </div>
                <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow md:flex md:items-center md:w-auto">
                    <div
                        class="w-full container mx-auto flex flex-col md:flex-row items-center justify-center text-md font-bold uppercase mt-0  py-2">
                        <a href="{{ route('webhome') }}"
                            class="hover:bg-gray-400 rounded py-2 text-white px-4 mx-2">Home</a>
                        @forelse ($pages_nav as $page)
                            <a href="{{ route('page.show', $page->slug) }}"
                                class="hover:bg-gray-400 rounded py-2 px-4 mx-2 text-white">{{ $page->name }}</a>
                        @empty
                            No pages_nav !
                        @endforelse
                    </div>
                </div>
            </nav>
            <div :class="open ? 'hidden' : 'block'" class=" items-center text-lg md:hidden no-underline text-white ">
                <a class="" href="{{ $setting->url_fb }}">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_insta }}">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_twitter }}">
                    <i class="fab fa-twitter"></i>
                </a>
                <a class="pl-6" href="{{ $setting->url_linkedin }}">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
            <nav class='flex list-none'>
                @auth
                    <!-- Settings Dropdown -->
                    <div class="flex sm:items-center sm:ml-6">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center border max-md:text-white border-transparent text-sm leading-4 font-medium rounded-md md:text-gray-500 text-black bg-transparent md:bg-white md:hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 w-32 py-1 px-3">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 mr-2 rounded-full"
                                        src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="user photo">
                                    {{ Auth::user()->name }}
                                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @can('admin-login')
                                    <x-dropdown-link :href="route('admin.index')">
                                        Control Panel
                                    </x-dropdown-link>
                                @endcan
                                {{-- @endcan --}}
                                <x-dropdown-link href="/dashboard">
                                    {{ __('Dashboard') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Setting') }}
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
                    </div>
                @else
                    <li><a class="py-2 px-4 mr-2 bg-gray-500 hover:bg-gray-700" href="{{ route('register') }}">Register</a>
                    <li><a class="py-2 px-4 bg-green-500 hover:bg-green-700" href="{{ route('login') }}">Login</a>
                    @endauth
            </nav>
        </div>

    </nav>

    <!-- Text Header -->
    <div class="w-full container mx-auto">
        <div class="flex flex-col items-center py-5">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('webhome') }}">
                {{ $setting->site_name }}
            </a>
            <p class="text-lg text-gray-600">
                {{ $setting->description }}
            </p>
        </div>
    </div>

    <!-- Search and Create posts -->

    <div class="flex py-4 border-t border-b bg-gray-100 w-full justify-between px-4">
        <form class="w-4/5 relative">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Mockups, Logos..." required>
                <button type="submit"
                    class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
            <select class="select__categories form-control" multiple="multiple">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </form>

        <button
            class="inline-flex items-center border text-medium leading-4 font-medium rounded-md  text-white bg-transparent bg-blue-800 md:hover:opacity-60 focus:outline-none transition ease-in-out duration-150 py-1 px-3">
            Chia sẻ cách fix bug
            <i class="text-white ml-2 fa-solid fa-plus"></i>
        </button>
    </div>
</header>
@push('script')
    <script>
        $(document).ready(function() {
            $(".select__categories").select2({
                tags: true,
                placeholder : "Chọn danh mục" , 
            })
        })
    </script>
@endpush
