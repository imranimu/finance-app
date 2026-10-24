<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-4 mb-8">
                <div class="bg-green-100 p-4 rounded shadow">Total Credit: {{ number_format($totalCredit, 2) }}</div>
                <div class="bg-red-100 p-4 rounded shadow">Total Debit: {{ number_format($totalDebit, 2) }}</div>
                <div class="bg-blue-100 p-4 rounded shadow">Balance: {{ number_format($totalCredit - $totalDebit, 2) }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
