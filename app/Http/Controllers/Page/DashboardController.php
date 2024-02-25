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
use App\Models\Page\Tag;

class DashboardController extends Controller
{
    public function index()
    {

        return view('Page.admin.dashboards.index');
    }
}
