<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProfileModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = ProductModel::select(ProductModel::raw('tbl_product.*,category.Name as CategoryName,CONCAT("' . url('/uploads/product') . '","/",tbl_product.Image) as ProductImage'))->leftJoin('tbl_category as category', 'tbl_product.Category', '=', 'category.id')->get();
        return view('home', ['products' => $products]);
    }
   
}
