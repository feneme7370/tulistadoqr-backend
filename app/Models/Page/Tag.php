<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Company;
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
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
