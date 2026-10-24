<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800">Categories</h2>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Add</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('success')) <div class="text-green-600 mb-4">{{ session('success') }}</div> @endif
                <table class="w-full text-left border-collapse">
                    <tr class="border-b"><th>Name</th><th>Type</th><th>Budget</th><th>Actions</th></tr>
                    @foreach($categories as $c)
                    <tr class="border-b">
                        <td class="py-2">{{ $c->name }}</td>
                        <td>{{ [1=>'Debit',2=>'Credit',3=>'Both'][$c->type] }}</td>
                        <td>{{ number_format($c->budgets, 2) }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $c) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('categories.destroy', $c) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
