<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'user_id',
        'company_id',
    ];

    // Relación muchos a muchos con imágenes
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_pictures');
    }
}
