<?php

namespace App\Http\Controllers\Dashboard;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    
    public function index(request $request)
    {
       $clients=client::when($request->search,function ($q)use ($request){
        return $q->where('name','like','%'.$request->search.'%')
        ->orwhere('phone','like','%'.$request->search.'%')
        ->orwhere('address','like','%'.$request->search.'%');
         })->latest()->paginate(5);
       return view('dashboard.clients.index',compact('clients'));
    }//end of index function


    public function create()
    {
        return view('dashboard.clients.create');
    }//end of create function


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        Client::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');
    }//end of store function

  



    public function edit(request $request ,client $client)
    {
        return view('dashboard.clients.edit',compact('client'));
    }//end of edit function

 
    public function update(Request $request,  Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
            'address' => 'required',
        ]);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        $client->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');
    }//end of update function


    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');
    }//end of destroy function



}//end of clients controller
