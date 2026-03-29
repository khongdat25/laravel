<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $brands = \App\Models\Brand::all();
        return view('user.category', compact('categories', 'brands'));
    }
    
}
