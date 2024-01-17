<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembershipController extends Controller
{
    public function index()
    {
        
        return view('Page.admin.memberships.index');
    }
}
