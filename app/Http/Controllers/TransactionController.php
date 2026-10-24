<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {
    public function index() {
        $transactions = Transaction::with('category')->where('user_id', Auth::id())->latest()->get();
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
