<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
        <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            @foreach($columns as $column)
                <th class="py-3 px-6 text-left">{{ ucfirst($column) }}</th>
            @endforeach
            <th class="py-3 px-8 text-left">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-600 text-sm">
        @foreach($items as $item)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                @foreach($columns as $column)
                    <td class="py-3 px-6 text-left break-words">{{ $item[$column] }}</td>
                @endforeach
                <td class="py-3 px-6">
                    <a href="{{ route($routeName . '.edit', $item->id) }}" class="text-blue-500">Edit</a> |
                    <form action="{{ route($routeName . '.destroy', $item->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
