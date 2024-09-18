<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit event: ' . $event->title) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('error'))
            <p class="dark:text-red-500"> {{ session('error') }}</p>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('events.update', $event) }}" x-data="{
                country: {{ old('country_id', $event->country_id) }},
                city: {{ old('city_id', $event->city_id) }},
                cities: [],
                onCountryChange(event) {
                    console.log('Esto es:' + event.target.value)
                    if (event.target.value > 0) {
                        axios.get(`/countries/${event.target.value}`).then(res => {
                            this.cities = res.data
                        }).catch(error => { console.log(error.message) })
                    }
                },
                init() {
                    if (this.country) {
                        this.onCountryChange({ target: { value: this.country } })
                    }
                }
            
            }" enctype="multipart/form-data"
                class="p-4 bg-gray-800 dark:bg-slate-800 rounded-md">
                @csrf
                @method('PATCH')
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Title') }}</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('Laracon event') }}" value="{{ old('title', $event->title) }}">
                        @error('title')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                        @error('slug')
                            <div class="text-sm dark:text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="country_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select an option') }}</label>
                        <select id="country_id" x-on:change="onCountryChange" name="country_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">{{ __('Choose a country') }}</option>
                            @foreach ($countries as $pais)
                                <option :value="{{ $pais->id }}"
                                    {{ old('country_id', $event->country_id) == $pais->id ? 'selected' : '' }}>{{ $pais->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="city_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Select an option') }}</label>
                        <select id="city_id" x-model='city' name="city_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <template x-for="ciudad in cities" :key="ciudad.id">
                                <option :value="ciudad.id" x-text="ciudad.name" :selected='ciudad.id == city'>
                                </option>
                            </template>
                        </select>
                        @error('city_id')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="address"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Address') }}</label>
                        <input type="text" id="address" name="address"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Laracon address" value="{{ old('address', $event->address) }}">
                        @error('address')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <div>
                             <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="">{{ __('Image of event') }}</label>
                            <img src="{{ Storage::url($event->image) }}" width="50px" alt="{{ __('Image of event') }}">
                        </div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">{{ __('Upload file') }}</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            id="file_input" type="file" name="image" accept="image/*">
                        @error('image')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Start Date') }}</label>
                        <input type="date" id="start_date" name="start_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ old('start_date', $event->start_date->format('Y-m-d')) }}">
                        @error('start_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('End Date') }}</label>
                        <input type="date" id="end_date" name="end_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('end_date', $event->end_date->format('Y-m-d')) }}">
                        @error('end_date')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Start Time') }}</label>
                        <input type="time" id="start_time" name="start_time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('start_time', $event->start_time->format('H:i')) }}">
                        @error('start_time')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="num_tickets"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('N.º Tickets') }}</label>
                        <input type="number" id="num_tickets" name="num_tickets"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="1" value="{{ old('num_tickets', $event->num_tickets) }}">
                        @error('num_tickets')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Description') }}</label>
                        <textarea id="description" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{ __('Write your description here...') }}">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <div class="text-sm text-red-400">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div>
                    <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">{{ __('Tags') }}</h3>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($tags as $tag)
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input id="vue-checkbox-list" type="checkbox" name="tags[]"
                                        value="{{ $tag->id }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        {{ in_array($tag->id, old('tags', $event->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <label for="vue-checkbox-list"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $tag->name }}</label>
                                </div>
                            </li>
                        @endforeach

                    </ul>
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
