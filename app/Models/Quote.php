<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getTotalAttribute($value)
    {
        return $value / 100;
    }

//
    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = $value * 100;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('qty');
    }
}
