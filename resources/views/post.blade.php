<x-blog-layout title="{{ $post_title }}">

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                @if ($post->image == 'dummy.jpg')
                    <img src="{{ asset('import/assets/post-pic-dummy.png') }}">
                @else
                    <img src="{{ asset("storage/$post->image") }}" width="1000" height="500">
                @endif
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

            <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
                <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                    @if ($post->user->avatar == null)
                    <img src="{{ asset('import/assets/profile-pic-dummy.png') }}" class="rounded-full shadow h-32 w-32">
                    @else
                    <img src="{{ asset("storage"). '/' . $post->user->avatar }}" class="rounded-full shadow h-32 w-32">
                    @endif
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

        </section>

</x-blog-layout>
