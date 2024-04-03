<x-blog-layout>
     <!-- Posts Section -->
 <section class="w-full md:w-2/3 flex flex-col items-center px-3">


        <!-- Article -->
        @forelse ($posts as $post)
        <article class="flex flex-col shadow my-4">
            <a href="{{ route('post.show', $post->slug ) }}" class="hover:opacity-75">
            <img src="{{ $post->image }}" width="1000" height="500">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('category.show', $post->category->slug) }} " class="text-blue-700 text-sm font-bold uppercase pb-4">{{ $post->category->name }}</a>
                <a href="{{ route('post.show', $post->slug ) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p href="#" class="text-sm pb-1">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $post->user->name }}</a>, Published on {{ $post->created_at }}
                </p>
                <p class="pb-3">{!! substr($post->content, 0, 100) !!} ...</p>
                {{-- <br /> --}}
                <a href="{{ route('post.show', $post->slug) }}" class="mt-px uppercase text-gray-800 font-bold hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
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
</x-blog-layout>
