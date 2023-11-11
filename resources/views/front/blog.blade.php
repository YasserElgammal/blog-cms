<style>
    @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

    .font-family-karla {
        font-family: karla;
    }
</style>

@extends('layouts.app')
@section('title', 'DI Blogs')
@section('class-page', 'home-page')
@section('content')
    <div class="bg-white font-family-karla">
        <div class="container mx-auto flex flex-wrap py-6">
            <section class="w-full md:w-2/3 flex flex-col items-center px-3">
                <!-- Article -->
                @forelse ($posts as $post)
                    <article class="flex flex-col shadow my-4">
                        <a href="{{ route('post.show', $post->slug) }}" class="hover:opacity-75">
                            <img src="{{ asset("storage/$post->image") }}" width="1000" height="500">
                        </a>
                        <div class="bg-white flex flex-col justify-start p-6">
                            <a href="{{ route('category.show', $post->category->slug) }} "
                                class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                            <a href="{{ route('post.show', $post->slug) }}"
                                class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                            <p href="#" class="text-sm pb-1">
                                By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>,
                                Published on {{ $post->created_at }}
                            </p>
                            <p class="pb-3">{!! substr($post->content, 0, 100) !!} ...</p>
                            {{-- <br /> --}}
                            <a href="{{ route('post.show', $post->slug) }}"
                                class="mt-px uppercase text-gray-800 font-bold hover:text-black">Continue Reading <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @empty
                    <p>
                        No Posts has been added
                    </p>
                @endforelse

                <!-- Pagination -->
                <div class="flex items-center py-8">
                    {{ $posts->links() }}
                </div>
            </section>
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
                    @if ($top->avatar == null)
                        <img src="{{ asset('import/assets/profile-pic-dummy.png') }}" class="w-10 h-10 rounded-full">
                    @else
                        <img class="w-10 h-10 rounded-full" src="{{ asset("storage/$top->avatar") }}" alt="">
                    @endif
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
    </div>
@endsection
