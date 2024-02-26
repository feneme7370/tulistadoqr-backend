<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){

        return view('Page.admin.roles.index');
    }
    public function permission(){

        return view('Page.admin.roles.permission');
    }
}
