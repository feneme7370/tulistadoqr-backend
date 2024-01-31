<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Tag;
use App\Models\Page\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price_original',
        'price_seller',
        'quantity',
        'description',
        'status',
        'image_hero_uri',
        'image_hero',
        'category_id',
        'company_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    // public function level()
    // {
    //     return $this->belongsTo(Level::class, 'level_id', 'id');
    // }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function suggestion()
    {
        return $this->hasOne(Suggestion::class, 'product_id', 'id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
    

}
