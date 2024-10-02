<?php

namespace Database\Seeders;

use App\Models\Page\ShippingMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingMethod::create([
            'name' => 'Envio a domicilio',
            'status' => 1,
            'user_id' => 1,
            'company_id' => 1,
        ]);
        ShippingMethod::create([
            'name' => 'Paso a retirar',
            'status' => 1,
            'user_id' => 1,
            'company_id' => 1,
        ]);
        ShippingMethod::create([
            'name' => 'Para la mesa',
            'status' => 1,
            'user_id' => 1,
            'company_id' => 1,
        ]);
    }
}
