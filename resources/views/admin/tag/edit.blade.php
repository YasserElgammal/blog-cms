<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Edit Tag</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Tag Details
                </p>
                <form method="POST" action="{{ route('admin.tag.update', $tag->id ) }}">
                    @csrf
                    @method('PUT')
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                <div class="mb-1">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tag Name</label>
                    <input type="name" id="name" value="{{ $tag->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ex: News" required name="name">
                </div>
                {{--  --}}
                </div>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded">Update Tag</button>
                </form>
            </div>
        </main>
    </div>
</x-admin-layout>

