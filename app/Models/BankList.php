<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BankList extends Model {
    protected $guarded = [];
    public function creditBills() { return $this->hasMany(CreditBill::class, 'bank_list_id'); }
}
