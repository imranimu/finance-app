<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmiList extends Model {
    protected $guarded = [];
    public function emiPerson() { return $this->belongsTo(EmiPerson::class, 'emi_person_id'); }
}
