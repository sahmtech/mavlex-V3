<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMSChannel extends Model
{
    protected $connection = 'sms';

    protected $table = 'channels';
}
