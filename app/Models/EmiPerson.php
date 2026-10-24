<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmiPerson extends Model {
    protected $guarded = [];
    public function emiLists() { return $this->hasMany(EmiList::class, 'emi_person_id'); }
}
