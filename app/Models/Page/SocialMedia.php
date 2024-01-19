<?php

namespace App\Models\Page;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'company_id',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_social_media')
                    ->withPivot('url')
                    ->withTimestamps();
    }
}
