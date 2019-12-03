<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use App\Order;
use App\Product;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
      
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact( 'client', 'categories', 'orders'));

    }//end of create

    public function store(Request $request, Client $client, product $product)
    {
       $request->validate([
       
       'products'=>'required|array',

       ]);
// dd($request->all());

        $order = $client->orders()->create([]);
       

        $order->products()->attach($request->products);


        $total_price=0;
       

        foreach($request->products as $id=> $quantity){

            $product=product::FindOrFail($id);
       
            $total_price+=$product->sale_price * $quantity['quantity'];
       
        $product->update

        (['stock'=>$product->stock - $quantity['quantity']]);
           
        }//end of foreach
   $order->update(['total_price'=>$total_price]);
//    $this->attach_order($request, $client);
   session()->flash('success', __('site.added_successfully'));

   return redirect()->route('dashboard.orders.index');
    
}//end of store

    public function edit(Client $client, Order $order)
    {
     

    }//end of edit

    public function update(Request $request, Client $client, Order $order)
    {
       

    }//end of update

    private function attach_order($request, $client)
    {
        

    }//end of attach order

    private function detach_order($order)
    {
        

    }//end of detach order

}//end of controller
