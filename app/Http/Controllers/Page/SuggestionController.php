<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestionController extends Controller
{
    public function index()
    {
        
        return view('Page.admin.suggestions.index');
    }
}
