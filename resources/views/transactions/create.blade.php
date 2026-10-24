<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Add Transaction</h2></x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white p-6 shadow-sm sm:rounded-lg">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="mb-4"><label>Date</label><input type="date" name="date" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label>Description</label><input type="text" name="description" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label>Amount</label><input type="number" step="0.01" name="amount" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4">
                    <label>Category</label>
                    <select name="category_id" class="w-full border-gray-300 rounded" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
