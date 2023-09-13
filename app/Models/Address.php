<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'city',
        'region',
        'street',
        'building',
        'floor',
        'user_id'
    ];
    // Address belong to one user
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
