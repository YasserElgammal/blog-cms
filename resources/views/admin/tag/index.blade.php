<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Tags</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Tags Records
                </p>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2" onclick="location.href='{{ route('admin.tag.create') }}';">Add Tag</button>
                <div class="bg-white overflow-auto">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ID</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Used Count</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $tag->id }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $tag->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $tag->posts->count() }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">

                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded" type="button"  onclick="location.href='{{ route('admin.tag.edit', $tag->id) }}';">Edit</button>
                                    <form type="submit" method="POST" style="display: inline" action="{{ route('admin.tag.destroy', $tag->id)}}" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                    <button class="px-4 py-1 text-white font-light tracking-wider bg-red-600 rounded" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
        </main>
    </div>
</x-admin-layout>

