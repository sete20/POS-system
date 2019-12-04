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
      
       
       $this->attach_order($request, $client);
        
       session()->flash('success', __('site.added_successfully'));

        return redirect()->route('dashboard.orders.index');
    
}//end of store

    public function edit(Client $client, Order $order)
    {
     
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.edit', compact('client', 'order', 'categories', 'orders'));
    }//end of edit

    public function update(Request $request, Client $client, Order $order)
    {
       
        $this->detach_order($order);

        $this->attach_order($request, $client);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('dashboard.orders.index');
// dd($request->all());
    }//end of update

    private function attach_order($request, $client)
    {
        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price=0;

        foreach($request->products as $id=> $quantity){

            $product=product::FindOrFail($id);
            // $product->decrement('stock', $quantity['quantity']); 
            $total_price+=$product->sale_price * $quantity['quantity'];
       
        $product->update

        (['stock'=>$product->stock - $quantity['quantity']]);
           
        }//end of foreach
   $order->update(['total_price'=>$total_price]);
   
}//end of attach order

    private function detach_order($order)
    {
        
        foreach($order->products as $product){
            $product->update([
                'stock'=>$product->stock + $product->pivot->quantity
            ]);
        }
        $order->delete();
    }//end of detach order

}//end of controller
