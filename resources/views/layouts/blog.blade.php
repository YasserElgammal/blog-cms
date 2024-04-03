<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @isset($title)
            {{ ucfirst($title) }} -
        @endisset {{ config('app.name') }}
    </title>
    <!-- Tailwind -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</head>

<body class="bg-white font-family-karla">
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
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    @foreach ($pages_nav as $page)
                        <li><a class="hover:text-gray-200 hover:underline px-4"
                                href="{{ route('page.show', $page->slug) }}">{{ $page->name }}</a></li>
                    @endforeach

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="py-2 px-4 bg-red-500 hover:bg-red-700">LogOut</button>
                        </form>
                    @else
                        <li><a class="py-2 px-4 mr-2 bg-gray-500 hover:bg-gray-700"
                                href="{{ route('register') }}">Register</a>
                        <li><a class="py-2 px-4 bg-green-500 hover:bg-green-700" href="{{ route('login') }}">Login</a>
                        @endauth

                </ul>
            </nav>

            <div class="flex items-center text-lg no-underline text-white pr-6">
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
        </div>

    </nav>

    <!-- Text Header -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="{{ route('webhome') }}">
                {{ $setting->site_name }}
            </a>
            <p class="text-lg text-gray-600">
                {{ $setting->description }}
            </p>
        </div>
    </header>

    <!-- Topic Nav -->
    <nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
        <div class="block sm:hidden">
            <a href="#"
                class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
                @click="open = !open">
                Topics <i :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" class="fas ml-2"></i>
            </a>
        </div>
        <div :class="open ? 'block' : 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
            <div
                class="w-full container mx-auto flex flex-col sm:flex-row items-center justify-center text-sm font-bold uppercase mt-0 px-6 py-2">
                <a href="{{ route('webhome') }}" class="hover:bg-gray-400 rounded py-2 px-4 mx-2">Home</a>
                @forelse ($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                        class="hover:bg-gray-400 rounded py-2 px-4 mx-2">{{ $category->name }}</a>
                @empty
                    No Categories !
                @endforelse
            </div>
        </div>
    </nav>


    <div class="container mx-auto flex flex-wrap py-6">

        {{ $slot }}

        <!-- Sidebar Section -->
        @if (!request()->routeIs('page.show'))
            <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <p class="text-xl font-semibold pb-5">About Us</p>
                    <p class="pb-2">{{ $setting->about }}</p>
                    {{-- <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a> --}}
                </div>

                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <p class="text-xl font-semibold pb-5">Tags</p>
                    <div class="flex flex-wrap">

                        @foreach ($tags as $tag)
                            <a href="{{ route('tag.show', $tag->name) }}"
                                class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-blue-700 bg-blue-100 border border-blue-300 ">
                                <div class="p-1.5 text-xs font-normal leading-none max-w-full flex-initial">
                                    {{ $tag->name }}</div>
                            </a>
                        @endforeach

                    </div>
                </div>

                <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                    <p class="text-xl font-semibold pb-5">Top 5 Writers</p>
                    {{--  --}}
                    <div class="content flex justify-between py-2 w-full">
                        <div class="px-2 justify-between">
                            Name

                        </div>
                        <div class="justify-between">
                            Posts Count
                        </div>
                    </div>
                    @forelse ($top_users as $top)
                        <div class="my-1.5 py-3	px-4 flex justify-center rounded-lg shadow-lg bg-white w-full ">
                                <img class="w-10 h-10 rounded-full" src="{{ $top->avatar }}"
                                    alt="">
                            <div class="content flex justify-between py-2 w-full">
                                <div class="px-2 justify-between">
                                    {{ $top->name }}
                                </div>
                                <div class="justify-between">
                                    {{ $top->posts_count }}
                                </div>
                            </div>
                        </div>
                    @empty
                        No Members !
                    @endforelse
                </div>

            </aside>
        @endif


    </div>

    <footer class="w-full border-t bg-white pb-12">

        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                @foreach ($pages_footer as $page)
                    <a href="{{ route('page.show', $page->slug) }}" class="uppercase px-3 hover:text-blue-700">{{ $page->name }}</a>
                @endforeach
            </div>
            <div class="uppercase pb-6">&copy; {{ $setting->copy_rights }}</div>
        </div>
    </footer>

</body>

</html>
