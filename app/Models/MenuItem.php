<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image',
        'is_top_selling',
        'is_available'
    ];

    // Relationship: Har item ki ek category hai
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}