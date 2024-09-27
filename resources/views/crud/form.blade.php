<x-app-layout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold">{{ isset($item) ? 'Edit' : 'Create' }} {{ $modelName }}</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($item) ? route($routeName . '.update', $item) : route($routeName . '.store') }}"
              method="POST">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif
            @foreach ($columns as $column)
                <div class="mb-4">
                    <label for="{{ $column }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        {{ ucfirst(str_replace('_', ' ', $column)) }}
                    </label>

                    @php
                        $inputType = $inputTypes[$column] ?? 'text';
                    @endphp

                    @if ($inputType === 'textarea')
                        <textarea name="{{ $column }}" id="{{ $column }}" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> {{ old($column, $item->$column ?? '') }}</textarea>
                    @elseif ($inputType === 'checkbox')
                        <input type="hidden" name="{{ $column }}" value="0">
                        <input
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                            type="checkbox" name="{{ $column }}" id="{{ $column }}"
                            value="1" {{ old($column, $item->$column ?? false) ? 'checked' : '' }}>

                    @elseif($inputTypes === "time")
                        <input type="time" name="{{ $column }}" id="{{ $column }}"
                               class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               min="09:00:00" max="18:00:00"
                               value="{{ old($column, $item->$column ?? '00:00:00') }}">
                    @else
                        <input type="{{ $inputType }}" name="{{ $column }}" id="{{ $column }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               value="{{ old($column, $item->$column ?? '') }}">
                    @endif
                </div>
            @endforeach
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Envoyer
            </button>
        </form>
    </div>
</x-app-layout>
