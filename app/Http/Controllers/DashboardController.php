<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Models\EmiList;
use App\Models\CreditBill;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $totalCredit = Transaction::whereHas('category', function($q){ $q->where('type', 2); })->sum('amount');
        $totalDebit = Transaction::whereHas('category', function($q){ $q->where('type', 1); })->sum('amount');

        $emis = EmiList::with('emiPerson')->orderBy('emi_date')->get();
        $bills = CreditBill::with('bankList')->orderBy('last_date')->get();

        return view('dashboard', compact('totalCredit', 'totalDebit', 'emis', 'bills'));
    }
}
