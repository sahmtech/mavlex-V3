<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobBatch extends Model
{
    use HasFactory;

    protected $table = 'job_batches';

    protected $fillable = [
        'uuid',
        'job_name',
        'total_chunks',
        'completed_chunks',
        'status',
        'business_id',    
        'chunk_size', 
    ];

    protected $casts = [
        'total_chunks' => 'integer',
        'completed_chunks' => 'integer',
    ];
}
