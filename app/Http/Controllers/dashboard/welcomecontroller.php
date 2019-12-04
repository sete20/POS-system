<?php

namespace App\Http\Controllers\dashboard;
use App\Category;
use DB;
use App\Client;
use App\Order;
use App\Product;
use App\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class welcomecontroller extends Controller
{
  public function index(){
          $categories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::whereRoleIs('admin')->count();

        $sales_data = Order::select(
            DB::raw('(created_at) as year'),
            DB::raw('(created_at) as month'),
            DB::raw('(total_price) as sum')
        )->groupBy('month')->get();

        return view('dashboard.welcome', compact('categories_count', 'products_count', 'clients_count', 'users_count', 'sales_data'));
  }
}
