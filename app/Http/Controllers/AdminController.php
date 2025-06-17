<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalProducts = Product::count();
        $totalCategories = ItemCategory::count();
        $totalOrders = Order::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalAmount = Order::where('status', 'selesai')->sum('amount');
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders', 'totalUsers', 'totalAmount'));
    }
}
