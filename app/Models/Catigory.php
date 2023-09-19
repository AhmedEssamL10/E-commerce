<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catigory extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
        'status'
    ];
}
