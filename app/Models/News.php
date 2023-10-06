<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'image',
        'admin_id'
    ];
    // Address belong to one admin
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin');
    }
}
