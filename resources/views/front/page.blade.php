<x-blog-layout title="{{ $page->name }}">

    {{-- <div class="container mx-auto flex flex-wrap py-6 w-full"> --}}

        <!-- Post Section -->
        <section class="w-full flex flex-col items-center px-3">

            <article class="flex flex-col w-full shadow my-4">
                <!-- Article Image -->
                <div class="bg-white flex flex-col justify-start p-6 w-">
                    <div class="text-3xl font-bold pb-4 text-center">{{ $page->name }}</div>
                    {!! $page->content !!}
                </div>
            </article>

        </section>

</x-blog-layout>
