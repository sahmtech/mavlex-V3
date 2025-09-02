<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Business;
class ProductReview extends Model
{
    protected $fillable = [
        'reviews', 'status', 'business_id', 'link',
    ];
    //
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
