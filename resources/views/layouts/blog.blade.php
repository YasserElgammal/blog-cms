<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
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

    <!-- Top Bar Nav -->
    <nav class="w-full py-4 bg-blue-800 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <nav>
                <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">
                    @foreach ($pages_nav as $page)
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ $page->slug }}">{{ $page->name }}</a></li>
                    @endforeach
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
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">{{ $setting->about }}</p>
                <a href="#"
                    class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Top Writers</p>
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
                        <img class="w-10 h-10 rounded-full"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=1" alt="">
                        <div class="content flex justify-between py-2 w-full">
                            <div class="px-2 justify-between">
                                {{ $top->name }}
                            </div>
                            <div class="justify-between">
                                {{ $top->posts_count }}
                            </div>
                        </div>
                    @empty
                        No Members !
                @endforelse
            </div>

        </aside>

    </div>

    <footer class="w-full border-t bg-white pb-12">

        <div class="w-full container mx-auto flex flex-col items-center">
            <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
                @foreach ($pages_footer as $page)
                <a href="{{ $page->slug }}" class="uppercase px-3 hover:text-blue-700">{{ $page->name }}</a>
                @endforeach
            </div>
            <div class="uppercase pb-6">&copy; {{ $setting->copy_rights }}</div>
        </div>
    </footer>

</body>

</html>
