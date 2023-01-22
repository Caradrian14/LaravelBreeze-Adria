<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use  \App\Models\Category;
class Ganga extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'ganga';

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
