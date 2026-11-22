<?php
/*namespace App\Http\Controllers;
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
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? (object) [
            'name'   => 'Imran Hossain',
            'email'  => 'imran@company.com',
            'role'   => 'Admin',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150',
        ];

        $stats = [
            ['title' => 'Total Income',            'value' => '৳ 4,86,320', 'icon' => 'ph-arrow-up-right',   'color' => 'green',  'trend' => 12, 'trendDirection' => 'up'],
            ['title' => 'Total Expenses',          'value' => '৳ 3,21,450', 'icon' => 'ph-arrow-down-right', 'color' => 'red',    'trend' => 8,  'trendDirection' => 'down'],
            ['title' => 'Net Profit',              'value' => '৳ 1,64,870', 'icon' => 'ph-bank',             'color' => 'blue',   'trend' => 15, 'trendDirection' => 'up'],
            ['title' => 'Outstanding Receivables', 'value' => '৳ 98,400',   'icon' => 'ph-file-text',        'color' => 'purple', 'trend' => 6,  'trendDirection' => 'down'],
        ];

        $recentTransactions = [
            ['date' => '10 Oct 2026', 'description' => 'Office Supplies',      'type' => 'expense', 'amount' => '৳ 12,450', 'status' => 'completed'],
            ['date' => '09 Oct 2026', 'description' => 'Client Payment - ABC', 'type' => 'income',  'amount' => '৳ 85,000', 'status' => 'completed'],
            ['date' => '08 Oct 2026', 'description' => 'Electricity Bill',     'type' => 'expense', 'amount' => '৳ 8,320',  'status' => 'completed'],
            ['date' => '07 Oct 2026', 'description' => 'Invoice #INV-1024',    'type' => 'income',  'amount' => '৳ 42,000', 'status' => 'pending'],
            ['date' => '06 Oct 2026', 'description' => 'Rent Payment',         'type' => 'expense', 'amount' => '৳ 50,000', 'status' => 'completed'],
        ];

        $cashFlows = [
            ['label' => 'Opening Balance', 'value' => '৳ 2,45,600'],
            ['label' => 'Total Inflow',    'value' => '৳ 4,86,320', 'class' => 'text-green'],
            ['label' => 'Total Outflow',   'value' => '৳ 3,21,450', 'class' => 'text-red'],
            ['label' => 'Closing Balance', 'value' => '৳ 2,10,470', 'total' => true],
        ];

        // Chart.js এর জন্য ডাটা
        $incomeExpenseChart = [
            'labels'   => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            'income'   => [320000, 350000, 410000, 380000, 450000, 470000, 510000, 480000, 520000, 486320],
            'expenses' => [250000, 280000, 310000, 290000, 330000, 310000, 340000, 320000, 350000, 321450],
        ];

        $expenseBreakdownChart = [
            'labels' => ['Rent', 'Salaries', 'Utilities', 'Supplies', 'Other'],
            'data'   => [50000, 120000, 18320, 45000, 88130],
        ];

        return view('dashboard', compact(
            'user',
            'stats',
            'recentTransactions',
            'cashFlows',
            'incomeExpenseChart',
            'expenseBreakdownChart'
        ) + ['expenseTotal' => '৳ 3,21,450']);
    }
}
