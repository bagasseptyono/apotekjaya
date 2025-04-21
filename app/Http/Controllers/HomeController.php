<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $itemcategory = ItemCategory::all();

        return view('index', compact('itemcategory'));
    }
}
