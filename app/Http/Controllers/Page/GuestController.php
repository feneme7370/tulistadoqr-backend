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
        $company = Company::where('id', 1)->first();
        $memberships = Membership::all();
        // dd($company->socialMedia[0]->pivot->url);
        return view('Page.guest.home', compact(
            'company',
            'memberships',
        ));
    }
}
