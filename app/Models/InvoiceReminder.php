<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceReminder extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the transaction related to this note.
     */
    public function transaction()
    {
        return $this->belongsTo(\App\Models\Transaction::class, 'transaction_id');
    }

    /**
     * Get the user.
     */
    public function created_user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
