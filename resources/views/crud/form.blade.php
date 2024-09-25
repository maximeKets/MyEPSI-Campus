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
        @if(isset($item))
            <form action="{{ route('floors.update', [ $item]) }}" method="POST">
                @method('PUT')

                @csrf
                @endif
                @if(!isset($item))
                    <form action="{{ route('floors.store') }}" method="POST">
                        @csrf
                        @endif
                        @foreach ($columns as $column)
                            <div class="mb-4">
                                <label for="{{ $column }}" class="block text-gray-700 text-sm font-bold mb-2">
                                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                                </label>

                                @php
                                    // Get the input type from the inputTypes array
                                    $inputType = $inputTypes[$column] ?? 'text';
                                @endphp

                                @if ($inputType === 'textarea')
                                    <textarea name="{{ $column }}" id="{{ $column }}"
                                              class="form-control">{{ old($column, $item->$column ?? '') }}</textarea>
                                @elseif ($inputType === 'checkbox')
                                    <input type="hidden" name="{{ $column }}" value="0">
                                    <!-- Hidden field for unchecked value -->
                                    <input type="checkbox" name="{{ $column }}" id="{{ $column }}"
                                           value="1" {{ old($column, $item->$column ?? false) ? 'checked' : '' }}>
                                @else
                                    <input type="{{ $inputType }}" name="{{ $column }}" id="{{ $column }}"
                                           class="form-control"
                                           value="{{ old($column, $item->$column ?? '') }}">
                                @endif
                            </div>
                        @endforeach

                        <button type="submit">Submit</button>

                    </form>
    </div>
</x-app-layout>
