<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">Roles</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> Roles Records
                </p>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-600 rounded mb-2" onclick="location.href='{{ route('admin.tag.create') }}';">Add Tag</button>
                <div class="bg-white overflow-auto">
                    <table class="text-left w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">ID</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Name</th>
                                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Used Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr class="hover:bg-grey-lighter">
                                <td class="py-4 px-6 border-b border-grey-light">{{ $role->id }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $role->name }}</td>
                                <td class="py-4 px-6 border-b border-grey-light">{{ $role->users>count() }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
        </main>
    </div>
</x-admin-layout>

