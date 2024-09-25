<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ucfirst($modelName) }} List
        </h2>
    </x-slot>
    <div class="container mx-auto py-6">

        <div class="mb-4">
            <a href="{{ route($routeName . '.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Creer {{ ucfirst($modelName) }}</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <x-data-table :items="$items" :columns="$columns" :routeName="$routeName" />    </div>
</x-app-layout>
