<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page\Company;

class ConfigController extends Controller
{
    public function index(Company $company)
    {
        return view('Page.admin.configs.index', compact('company'));
    }
}
