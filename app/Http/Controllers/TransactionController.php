<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {
    /*public function index() {
        $transactions = Transaction::with('category')->where('user_id', Auth::id())->latest()->get();
        return view('transactions.index', compact('transactions'));
    }*/
    public function index()
    {
        $transactions = [
            ['date' => '10 Oct 2026', 'description' => 'Office Supplies',      'type' => 'expense', 'amount' => '৳ 12,450', 'status' => 'completed'],
            ['date' => '09 Oct 2026', 'description' => 'Client Payment - ABC', 'type' => 'income',  'amount' => '৳ 85,000', 'status' => 'completed'],
            ['date' => '08 Oct 2026', 'description' => 'Electricity Bill',     'type' => 'expense', 'amount' => '৳ 8,320',  'status' => 'completed'],
            ['date' => '07 Oct 2026', 'description' => 'Invoice #INV-1024',    'type' => 'income',  'amount' => '৳ 42,000', 'status' => 'pending'],
            ['date' => '06 Oct 2026', 'description' => 'Rent Payment',         'type' => 'expense', 'amount' => '৳ 50,000', 'status' => 'completed'],
        ];

        return view('transactions.index', compact('transactions'));
    }

    public function create() {
        $categories = Category::all();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'date'=>'required|date', 'description'=>'required',
            'amount'=>'required|numeric', 'category_id'=>'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id(); // Attach to logged in user
        Transaction::create($data);
        return redirect()->route('transactions.index')->with('success', 'Saved.');
    }

    // ... implement edit, update, destroy similarly
    public function edit(Transaction $transaction) {
        $this->authorize('update', $transaction);
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction) {
        $this->authorize('update', $transaction);
        $request->validate([
            'date'=>'required|date', 'description'=>'required',
            'amount'=>'required|numeric', 'category_id'=>'required'
        ]);
        $transaction->update($request->all());
        return redirect()->route('transactions.index')->with('success', 'Updated.');
    }

    public function destroy(Transaction $transaction) {
        $this->authorize('delete', $transaction);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Deleted.');
    }
}
