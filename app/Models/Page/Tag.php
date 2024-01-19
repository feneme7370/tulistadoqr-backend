<?php

namespace App\Models\Page;

use App\Models\Page\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'company_id',
        'user_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
