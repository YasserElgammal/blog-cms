<x-blog-layout>

    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">

            <article class="flex flex-col w-full shadow my-4">
                <!-- Article Image -->
                <div class="bg-white flex flex-col justify-start p-6">
                    <div class="text-3xl font-bold pb-4">{{ $page->name }}</div>
                    {!! $page->content !!}
                </div>
            </article>

        </section>

</x-blog-layout>
