<?php

namespace App\Http\Controllers\dashboard;
use Intervention\Image\Facades\Image;
use App\user;
use Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //create read update delete
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }//end of construct

    public function index(request $request)
    {
        // if($request->search){
        //     $users= User::where('first_name','like','%'>$request->serach.'%')
        //     ->orwhere('last_name','like','%'>$request->serach.'%')->get();

        // }else{
        //     $users = User::whereRoleIs('admin')->get();
        // }
        // if($request->search){ dd($request->all());}
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) 
        {
 return $q->when($request->search, function ($query) use ($request) 
{
 return $query->where('first_name', 'like', '%' . $request->search . '%')->orWhere
 ('last_name', 'like', '%' . $request->search . '%');
});
 })->latest()->paginate(5);
   
        return view('dashboard.users.index',compact('users'));
    }//end of index
  
   
    public function create()
    {
        return view('dashboard.users.create');
    }//end of create function

    

    public function store(Request $request)
    {
    //     dd($request->all());
    //    //////////////////////////////
       $request->validate([
'first_name'=>'required',
'last_name'=>'required',
'email' => 'required|unique:users',
'password'=>'required|confirmed',
'permissions' => 'required|min:1',
'image'=>'image'
       ]);
       //////////////////////////////
       $request_data = $request->except(['password', 'password_confirmation', 'permissions','image']);
       $request_data['password'] = bcrypt($request->password);
       if ($request->image) {

        Image::make($request->image)
            ->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(public_path('uploads/user_images/' . $request->image->hashName()));

        $request_data['image'] = $request->image->hashName();

    }//end of if
        // dd($request_data);
    $user = User::create($request_data);
    $user->attachRole('admin');
    $user->syncPermissions($request->permissions);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.users.index');;
    }//end of store
 
    public function edit(user $user)
    {
        return view('dashboard.users.edit',compact('user'));
    }   // end of edit
    ////////////////////////////////
    public function update(Request $request, user $user)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'permissions' => 'required|min:1',
            'image'=>'image'
                   ]);
                   //////////////////////////////
                   $request_data = $request->except(['permissions','image']);
                   if ($request->image) {

                if($request->image !='default.png'){
                Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
                }//end son if
                Image::make($request->image)
                ->resize(600, 600, function ($constraint) {
                $constraint->aspectRatio();
                })
                ->save(public_path('uploads/user_images/' . $request->image->hashName()));
                $request_data['image'] = $request->image->hashName();
                }//end of if
                   
                   $user->update($request_data);

                   $user->syncPermissions($request->permissions);
                   session()->flash('success', __('site.updated_successfully'));
                   return redirect()->route('dashboard.users.index');

    }//end of update

   
    public function destroy(user $user)
    {
        if ($user->image != 'default.png') {

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);

        }//end of if
        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');
    }
}
