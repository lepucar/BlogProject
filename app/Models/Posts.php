<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id'
    ];

    public function users()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }
}
