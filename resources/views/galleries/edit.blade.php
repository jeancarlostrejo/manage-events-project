<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit gallery') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('error'))
            <p class="dark:text-red-500"> {{ session('error') }}</p>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('galleries.update', $gallery) }}" enctype="multipart/form-data"
                class="p-4 bg-gray-800 dark:bg-slate-800 rounded-md">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="caption"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Caption') }}</label>
                    <input type="text" id="caption" name="caption"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="{{ __('Image caption') }}" value="{{ old('caption', $gallery->caption) }}">
                    @error('caption')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <img src="{{ Storage::url($gallery->image) }}" alt="Image of gallery" class="w-20 h-20">

                    <label for="file_input"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Upload file') }}</label>
                    <input type="file"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        id="file_input" name="image">
                    @error('image')
                        <div class="text-sm text-red-400">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mt-2">
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ __('Update') }}</button>
                        <a href="{{ route('events.index') }}" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">{{ __('Cancel') }}</a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
