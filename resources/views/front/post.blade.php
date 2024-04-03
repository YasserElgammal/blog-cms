<x-blog-layout title="{{ $post_title }}">

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">


            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                    <img src="{{ $post->image }}" width="1000" height="500">
                <div class="bg-white flex flex-col justify-start p-6">
                    <a href="{{ route('category.show', $post->category->slug) }}"
                        class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                    <div class="text-3xl font-bold pb-4">{{ $post->title }}</div>
                    <p href="#" class="text-sm pb-8">
                        By <a href="#" class="font-semibold hover:text-blue-800">{{ $post->user->name }}</a>,
                        Published on {{ $post->created_at }}
                    </p>
                    {!! $post->content !!}
                </div>
            </article>
            {{-- author --}}
            <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                        <img src="{{ $post->user->avatar }}"
                            class="rounded-full shadow h-32 w-32">
                </div>
                <div class="flex-1 flex flex-col justify-center md:justify-start">
                    <p class="font-semibold text-2xl">{{ $post->user->name }}</p>
                    <p class="pt-2">{{ $post->user->bio }}</p>
                    <div
                        class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                        <a class="" href="{{ $post->user->url_fb }}">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->url_insta }}">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->url_twitter }}">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="pl-4" href="{{ $post->user->url_linkedin }}">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            {{--  --}}
            {{-- comment section --}}
            @auth
                @if ($errors->any())
                    <div role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2 mx-4">
                            Validation Errors
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700 mx-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <div class="w-full flex text-center md:text-left md:flex-col shadow bg-white mt-10 mb-10 p-6">
                    <p class="font-semibold text-2xl pb-2">Comment As: {{ auth()->user()->name }}</p>
                    <form method="POST" action="{{ route('post.comment', $post) }}">
                        @csrf
                        <textarea class="w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg" name="body" cols="30" rows="10" placeholder="Write your comment here .."></textarea>
                        <button type="submit"
                            class="mt-2 py-2 px-4 bg-green-500 hover:bg-green-700 hover:text-white">Submit
                            Comment</button>
                    </form>
                </div>
            @else
                <div class="w-full flex text-center md:text-left md:flex-col shadow bg-red-400 mt-10 mb-10 p-6">
                    <p class="font-semibold text-white text-2xl pb-2"> Signin to able to comment !</p>
                </div>
            @endauth

            <div class="w-full flex text-center md:text-left md:flex-col shadow bg-white mt-10 mb-10 p-6">
                <p class="font-semibold text-2xl pb-2">Comments</p>
                {{-- user comments --}}
                @foreach ($comments as $comment)
                    <div class="w-full flex text-center md:text-left md:flex-col shadow bg-white mt-10 mb-10 p-6">
                        <p class="font-semibold text-xl pb-2">{{ $comment->user->name }}</p>
                        <p class="font-semibold text-gray-600 text-lg pb-2">{{ $comment->body }}</p>
                        @can('delete', $comment)
                            <form method="POST" action="{{ route('comment.destroy', $comment->id) }}"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="py-2 px-4 bg-red-500 hover:bg-red-700 hover:text-white">Delete</button>
                            </form>
                        @endcan
                    </div>
                @endforeach
                {{--  --}}
            </div>

            <div class="w-full flex pt-6">
                @if (isset($post->previous))
                    <a href="{{ route('post.show', $post->previous->slug) }}"
                        class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center"><i
                                class="fas fa-arrow-left pr-1"></i> Previous</p>
                        <p class="pt-2">{{ $post->previous->title }}</p>
                    </a>
                @else
                    <div class="w-1/2 bg-white shadow hover:shadow-md text-left p-6">
                        <p class="pt-2">This is the first post</p>
                    </div>
                @endif

                @if (isset($post->next))
                    <a href="{{ route('post.show', $post->next->slug) }}"
                        class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                        <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <i
                                class="fas fa-arrow-right pl-1"></i></p>
                        <p class="pt-2">{{ $post->next->title }}</p>
                    </a>
                @else
                    <div class="w-1/2 bg-white shadow hover:shadow-md text-right p-6">
                        <p class="pt-2">This is the last post</p>
                    </div>
                @endif
            </div>



        </section>

</x-blog-layout>
