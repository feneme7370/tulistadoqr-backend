<?php

namespace App\Models\Page;

use App\Models\User;
use App\Models\Page\Client;
use App\Models\Page\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'client',
        'adress',
        'type_send',
        'description',
        'is_maked',
        'is_paid',
        'is_delivered',
        'is_completed',
        'status',
        'total_price',
        'total_cost',
        'total_products',
        
        'shipping_methods_id',
        'client_id',
        'user_id',
        'company_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity', 'discount', 'price', 'total_price', 'cost', 'total_cost') // Campos adicionales en la tabla pivote
            ->withTimestamps(); // Si tienes timestamps en la tabla pivote;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_methods_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
