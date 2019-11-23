<?php

namespace App\Http\Controllers\dashboard;
use Illuminate\Validation\Rule;
use App\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

 
    public function index(request $request)
    {
        $categories=category::when($request->search,function($q)use($request) {
return $q->where('name','like','%'.$request->search.'%');
        })->latest()->paginate(5);
        return view('dashboard.categories.index',compact(['categories']));
    }//end of index function


    public function create()
    {
        return view('dashboard.categories.create');
    }//end of create function

    public function store(Request $request)
    {
  
        $rules = [];
      foreach(config('translatable.locales')  as $locale){
        $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];
      }
      $request->validate($rules);

      

     category::create($request->all());
     session()->flash('success', __('site.added_successfully'));;
     return redirect()->route('dashboard.categories.index');
    }//end of stroy function

   

    public function edit(category $category)
    {
        return view('dashboard.categories.edit',compact(['category']));
    }//end of edit function

    public function update(Request $request, category $category)
    {
        $rules = [];
        foreach(config('translatable.locales')  as $locale){
          $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')->ignore($category->id)]];
        }
        $request->validate($rules);
        $category->update($request->all());
        session()->flash('success', __('site.updated_successfully'));;
        return redirect()->route('dashboard.categories.index');
    }//end of update function

    public function destroy(category $category)
    {
    $category->delete();
    session()->flash('success', __('site.deleted_successfully'));;
    return redirect()->route('dashboard.categories.index');
    }//end of destroy function

}//end of controller
