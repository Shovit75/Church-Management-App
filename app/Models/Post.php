<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'video',
        'image',
        'webuser_id',
        'category_id',
    ];

    public function webuser()
    {
        return $this->belongsTo(Webuser::class, 'webuser_id');
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
