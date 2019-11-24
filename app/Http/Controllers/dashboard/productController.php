<?php

namespace App\Http\Controllers\dashboard;
use App\Category;
use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( request $request)
    {
        $categories = Category::all();

        $products = Product::paginate(5);

        return view('dashboard.products.index', compact('categories', 'products'));

    }//end of index

 
    public function create()
    {
        return view('dashboard.categories.index');
    }//end of create

    
    public function store(Request $request)
    {
        //
    }//end of store

    public function show(product $product)
    {
        //
    }//end of show

    public function edit(product $product)
    {
        //
    }//end of edit

    
    public function update(Request $request, product $product)
    {
        //
    } //end of update


    public function destroy(product $product)
    {
        //
    } //end of destroy


}//end of controller
