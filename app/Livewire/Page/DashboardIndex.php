<?php

namespace App\Livewire\Page;

use App\Models\User;
use Livewire\Component;
use App\Models\Page\Tag;
use App\Models\Page\Level;
use App\Models\Page\Company;
use App\Models\Page\Product;
use App\Models\Page\Category;
use App\Models\Page\Membership;
use App\Models\Page\Suggestion;

class DashboardIndex extends Component
{
    public function render()
    {
        $companies = Company::orderBy('id', 'DESC')->get();
        $memberships = Membership::orderBy('id', 'DESC')->get();
        $users = User::orderBy('id', 'DESC')->get();   

        $categories = Category::where('company_id', auth()->user()->company_id)->get();   
        $levels = Level::where('company_id', auth()->user()->company_id)->get();   
        $products = Product::where('company_id', auth()->user()->company_id)->get();   
        $suggestions = Suggestion::where('company_id', auth()->user()->company_id)->get();   
        $tags = Tag::where('company_id', auth()->user()->company_id)->get();

        return view('livewire.page.dashboard-index', compact(
            'companies', 
            'users', 
            'memberships', 
            'categories', 
            'levels', 
            'products', 
            'suggestions', 
            'tags',
        ));
    }
}
