<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'adress',
        'city',
        'social',
        'description',
        'status',
        'image_logo',
        'image_hero',
        'membership_id',
    ];

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id', 'id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'company_id', 'id');
    }

    public function levels()
    {
        return $this->hasMany(Level::class, 'company_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'company_id', 'id');
    }
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class, 'company_id', 'id');
    }

    public function socialMedia()
    {
        return $this->belongsToMany(SocialMedia::class, 'company_social_media')
                    ->withPivot('url')
                    ->withTimestamps();
    }
}
