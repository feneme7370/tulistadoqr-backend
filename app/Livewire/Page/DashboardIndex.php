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
        $companies = Company::count();
        $memberships = Membership::count();
        $users = User::count();   

        $categories = Category::where('company_id', auth()->user()->company_id)->count();   
        $levels = Level::where('company_id', auth()->user()->company_id)->count();   
        $products = Product::where('company_id', auth()->user()->company_id)->count();   
        $suggestions = Suggestion::where('company_id', auth()->user()->company_id)->count();   
        $tags = Tag::where('company_id', auth()->user()->company_id)->count();   
        
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
