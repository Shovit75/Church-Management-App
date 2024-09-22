<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postadmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'video',
        'image',
        'user_id',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function prayers()
    {
        return $this->morphMany(Prayer::class, 'prayable');
    }
}
