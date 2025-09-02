<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSMessage extends Model
{
    protected $connection = "sms";
    protected $table = 'transactions';
}
