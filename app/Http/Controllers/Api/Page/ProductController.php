<?php

namespace App\Http\Controllers\Api\Page;

use App\Models\Page\Level;
use App\Models\Page\Company;
use App\Models\Page\Product;
use Illuminate\Http\Request;
use App\Models\Page\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Page\LevelResource;
use App\Http\Resources\Page\CompanyResource;
use App\Http\Resources\Page\ProductResource;
use App\Http\Resources\Page\CategoryResource;
use App\Http\Resources\Page\TagResource;
use App\Models\Page\Tag;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        $products = Product::where('company_id', $company->id)->where('status', 1)->orderBy('name', 'ASC')->get();
        $responseProducts = ProductResource::collection($products);

        $levels = Level::where('company_id', $company->id)->where('status', 1)->orderBy('name', 'ASC')->get();
        $responseLevels =  LevelResource::collection($levels);

        $categories = Category::where('company_id', $company->id)->where('status', 1)->orderBy('name', 'ASC')->get();
        $responseCategories = CategoryResource::collection($categories);

        $companies = Company::where('id', $company->id)->where('status', 1)->orderBy('id', 'DESC')->get();
        $responseCompany = CompanyResource::collection($companies);

        $tags = Tag::where('id', $company->id)->orderBy('name', 'ASC')->get();
        $responseTag = TagResource::collection($tags);

        $array_products = [
            'responseProducts' => $responseProducts, 
            'responseLevels' => $responseLevels,
            'responseCategories' => $responseCategories,
            'responseCompany' => $responseCompany,
            'responseTag' => $responseTag,

        ];
        return $array_products;

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
