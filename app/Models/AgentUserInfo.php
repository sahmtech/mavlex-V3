<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentUserInfo extends Model
{
    protected $connection = 'agent';

    protected $table = 'user_infos';
}
