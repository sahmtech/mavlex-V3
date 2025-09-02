<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentDetail extends Model
{
    // use SoftDeletes;

    protected $fillable = ['transaction_id','full_name','email','phone','address'];

    public function transaction(){
        return $this->belongsTo('App\Models\Transaction','transaction_id','id');
    }
}
