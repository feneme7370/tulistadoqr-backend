<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    { 
        return view('Page.admin.users.index');
    }
    public function userIsStatus()
    { 
        return view('auth.user-status');
    }
}
