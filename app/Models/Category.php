<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order'
    ];

    // Yeh function batata hai ki Category ke paas bahut saare Menu Items hain
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class);
    }
}