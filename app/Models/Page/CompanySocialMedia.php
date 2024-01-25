<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_media_id',
        'company_id',
        'url',
    ];

}
