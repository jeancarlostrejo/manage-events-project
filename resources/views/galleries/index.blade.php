<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gallery') }}
            </h2>
            <div>
                <a href="{{ route('galleries.create') }}"
                    class="dark:text-white dark:bg-green-700 rounded-lg p-2  hover:text-slate-200 font-semibold">{{ __('New Gallery') }}</a>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-lg text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Image') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Caption') }}
                            </th>
                            <th scope="col" class="px-6 py-3">
                                {{ __('Action') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $gallery)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <img src="{{ Storage::disk('public')->url($gallery->image) }}" alt="Image of gallery" class="w-20 h-20">
                                </th>
                                <td class="px-6 py-4">
                                    {{ $gallery->caption }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('galleries.edit', $gallery) }}"
                                            class="text-green-400 hover:text-green-600">{{ __('Edit') }}</a>
                                        <form method="POST" class="text-red-400 hover:text-red-600"
                                            action="{{ route('galleries.destroy', $gallery) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('galleries.destroy', $gallery) }}"
                                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                {{ __('Delete') }}
                                            </a>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    {{ __('No gallery found') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
