<?php

namespace App\Http\Controllers\Api\Page;

use Illuminate\Http\Request;
use App\Models\Page\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\CategoryResource;
use App\Models\Page\Company;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        $categories = Category::where('company_id', $company->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
