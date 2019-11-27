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
        $orders = $client->orders()->with('products')->paginate(5);
        return view('dashboard.clients.orders.create', compact( 'client', 'categories', 'orders'));

    }//end of create

    public function store(Request $request, Client $client)
    {
       
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
