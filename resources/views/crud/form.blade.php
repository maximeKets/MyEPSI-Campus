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

        <form action="{{ isset($item) ? route($routeName . '.update', $item) : route($routeName . '.store') }}" method="POST">
            @csrf
            @if(isset($item))
                @method('PUT')
            @endif
            @foreach ($columns as $column)
                <div class="mb-4">
                    <label for="{{ $column }}" class="block text-gray-700 text-sm font-bold mb-2">
                        {{ ucfirst(str_replace('_', ' ', $column)) }}
                    </label>

                    @php
                        $inputType = $inputTypes[$column] ?? 'text';
                    @endphp

                    @if ($inputType === 'textarea')
                        <textarea name="{{ $column }}" id="{{ $column }}" class="form-control">{{ old($column, $item->$column ?? '') }}</textarea>
                    @elseif ($inputType === 'checkbox')
                        <input type="hidden" name="{{ $column }}" value="0">
                        <input type="checkbox" name="{{ $column }}" id="{{ $column }}" value="1" {{ old($column, $item->$column ?? false) ? 'checked' : '' }}>
                    @else
                        <input type="{{ $inputType }}" name="{{ $column }}" id="{{ $column }}" class="form-control" value="{{ old($column, $item->$column ?? '') }}">
                    @endif
                </div>
            @endforeach

            <button type="submit">Submit</button>
        </form>
    </div>
</x-app-layout>
