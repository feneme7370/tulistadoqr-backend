<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'image_hero',
        'image_hero_uri',
        'level_id',
        'user_id',
        'company_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }
}
