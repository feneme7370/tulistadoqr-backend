<?php

namespace App\Http\Controllers\Page;

use App\Models\User;
use App\Models\Page\Company;
use Illuminate\Http\Request;
use App\Models\Page\Category;
use App\Models\Page\Membership;
use App\Http\Controllers\Controller;
use App\Models\Page\Level;
use App\Models\Page\Product;
use App\Models\Page\Suggestion;

class DashboardController extends Controller
{
    public function index()
    {
        // $products = Product::where('company_id', auth()->user()->company_id)->count();   
        // $suggested = Suggested::where('company_id', auth()->user()->company_id)->count();   
        
        
        $companies = Company::count();
        $memberships = Membership::count();
        $users = User::count();   

        $categories = Category::where('company_id', auth()->user()->company_id)->count();   
        $levels = Level::where('company_id', auth()->user()->company_id)->count();   
        $products = Product::where('company_id', auth()->user()->company_id)->count();   
        $suggestions = Suggestion::where('company_id', auth()->user()->company_id)->count();   

        return view('Page.admin.dashboard', compact('companies', 'users', 'memberships', 'categories', 'levels', 'products', 'suggestions'));
    }
}
