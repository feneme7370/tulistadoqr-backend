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
        'category',
        'level',
        'product',
        'user',
        'suggestion',
        'status',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'membership_id', 'id');
    }
}
