<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Edit Category</h2></x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Type</label>
                    <select name="type" class="w-full border-gray-300 rounded">
                        <option value="1" {{ $category->type == 1 ? 'selected' : '' }}>Debit</option>
                        <option value="2" {{ $category->type == 2 ? 'selected' : '' }}>Credit</option>
                        <option value="3" {{ $category->type == 3 ? 'selected' : '' }}>Both</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label>Budget</label>
                    <input type="number" step="0.01" name="budgets" value="{{ $category->budgets }}" class="w-full border-gray-300 rounded">
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
