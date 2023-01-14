<x-admin-layout>

    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="w-full text-3xl text-black pb-6">User Profile</h1>

            <div class="w-full mt-12">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> User Details
                </p>
                <div class="flex items-center justify-center mb-4">



                    <form method="POST" action="{{ route('admin.account.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if ($user->avatar == null)
                            <img src="{{ asset('import/assets/profile-pic-dummy.png') }}"
                                class="rounded-full shadow h-32 w-32">
                        @else
                            <img src="{{ asset('storage') . '/' . $user->avatar }}"
                                class="rounded-full shadow h-32 w-32">
                        @endif
                        <label class="ml-4 block text-sm text-gray-600" for="message">Choose Image: </label>
                        <input class="ml-2" type="file" id="myimage" name="avatar">
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div class="mb-1">
                        <label for="url_insta"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Instagram
                            URL</label>
                        <input type="text" name="url_insta" id="url_insta" value="{{ $user->url_insta }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-1">
                        <label for="url_twitter"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Twitter URL</label>
                        <input type="text" name="url_twitter" id="url_twitter" value="{{ $user->url_twitter }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-1">
                        <label for="url_linkedin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">LinkedIN
                            URL</label>
                        <input type="text" name="url_linkedin" id="url_linkedin" value="{{ $user->url_linkedin }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-1">
                        <label for="url_fb"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Facebook
                            URL</label>
                        <input type="text" name="url_fb" id="url_fb" value="{{ $user->url_fb }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    {{--  --}}
                </div>
                <div class="mb-2">
                    <label class="block text-sm text-gray-600" for="bio">Bio</label>
                    <textarea class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="bio" name="bio" required="">{{ $user->bio }}</textarea>
                </div>
                <button class="px-4 py-1 text-white font-light tracking-wider bg-green-600 rounded">Update
                    Profile</button>
                </form>
            </div>
        </main>
    </div>
</x-admin-layout>
