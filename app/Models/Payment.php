<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    // use SoftDeletes;

    protected $fillable = ['user_id','package_id','transactionId', 'transaction_id', 'amount','description','requery_response','status','title','callback_url', 'request_payload'];

    public function user(){
        $biz = $this->belongsTo('App\Models\Business','user_id','id');
        // return \App\Models\User::find($biz->owner_id);
        return $biz;
    }
}
