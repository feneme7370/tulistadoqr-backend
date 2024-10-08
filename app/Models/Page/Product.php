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
        'cost',
        'quantity',
        'description',
        'description2',
        'description3',
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
    // Relación muchos a muchos con imágenes
    public function pictures()
    {
        return $this->belongsToMany(Picture::class, 'product_pictures');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')
            ->withPivot('quantity', 'discount', 'price', 'total_price', 'cost', 'total_cost') // Campos adicionales en la tabla pivote
            ->withTimestamps(); // Si tienes timestamps en la tabla pivote;
    }    
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'product_id', 'id');
    }

}
