<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditBill extends Model {
    protected $guarded = [];
    public function bankList() { return $this->belongsTo(BankList::class, 'bank_list_id'); }
}
