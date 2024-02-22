<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'short_description',
        'description',
        'category',
        'level',
        'product',
        'user',
        'suggestion',
        'tag',
        'list_product',
        'status',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'membership_id', 'id');
    }
}
