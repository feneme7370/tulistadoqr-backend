<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Company;
use App\Models\Page\Membership;

class GuestController extends Controller
{
    public function index()
    {
        // datos de los 4 planes vigentes
        $services = [
            'one' => [
                'title' => 'Facil gestion', 
                'description' => 'Sistema facil de usar, intuitivo y rapido.', 
                'icon' => 'fast', 
            ],
            'two' => [
                'title' => 'Acceso QR', 
                'description' => 'Accede al menu desde el QR o link.',
                'icon' => 'qr',
            ],
            'three' => [
                'title' => 'Multiples Menus', 
                'description' => 'Elegi la mejor forma de mostrar tus productos.', 
                'icon' => 'pages'
            ],
            'four' => [
                'title' => 'Productos con imagenes', 
                'description' => 'Se puede cargar una imagen por producto.', 
                'icon' => 'images'
            ],
        ];

        // datos de la firma propia, con ID 1
        $company = Company::with('socialMedia')->where('id', 1)->first();

        // membresias activas
        $memberships = Membership::where('status', '1')->get();

        return view('Page.guest.home', compact(
            'company',
            'memberships',
            'services',
        ));
    }
}
