<?php

namespace App\Http\Controllers\dashboard;
use App\Category;
use Intervention\Image\Facades\Image;
use Illuminate\Validation\Rule;
use App\product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class productController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::when($request->search,function($q)use ($request){
return $q->wheretranslationlike('name','%'.$request->search.'%');

    })->when($request->category_id,function($q)use($request){
return $q->where('category_id',$request->category_id);

    })->latest()->paginate(5);

        return view('dashboard.products.index', compact('categories', 'products'));

    }//end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));

    }//end of create

    public function store(Request $request)
    {

        $rules = ['category_id' => 'required' ];

 
        foreach(config('translatable.locales')  as $locale){
            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];
        }
        
        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'Expiration_date'=> 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        Product::create($request_data);
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');

    }//end of store

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', compact('categories'));

    }//end of edit

    public function update(Request $request, Product $product)
    {
        $rules = ['category_id' => 'required' ];

 
        foreach(config('translatable.locales')  as $locale){
            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];
        }
        
        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required',
            'Expiration_date'=> 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();

        if ($request->image) {

            Image::make($request->image)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }//end of if

        Product::update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');


    }//end of update

    public function destroy(Product $product)
    {
      
    }//end of destroy
}