<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginBusiness extends Model
{
    protected $connection = 'admin';

    protected $table = 'login_businesss';
}
