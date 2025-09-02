<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSSenderID extends Model
{
    protected $connection = 'sms';

    protected $table = 'sender_i_d_s';
}
