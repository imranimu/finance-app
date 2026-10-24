<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Add Category</h2></x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label>Name</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label>Type</label>
                    <select name="type" class="w-full border-gray-300 rounded">
                        <option value="1">Debit</option>
                        <option value="2">Credit</option>
                        <option value="3">Both</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label>Budget</label>
                    <input type="number" step="0.01" name="budgets" class="w-full border-gray-300 rounded" value="0">
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
