<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Order;
use App\Models\Page\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'adress',
        'phone',
        'email',
        'city',
        'country',
        'description',
        
        'status',
        
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
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_id', 'id');
    }


}
