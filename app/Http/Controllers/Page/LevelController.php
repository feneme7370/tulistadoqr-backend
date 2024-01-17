<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        
        return view('Page.admin.levels.index');
    }
}
