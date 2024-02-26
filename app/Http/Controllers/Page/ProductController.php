<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        
        return view('Page.admin.products.index');
    }

    public function price() {
        return view('Page.admin.products.price');
    }
}
