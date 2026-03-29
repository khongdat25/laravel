<?php

namespace App\Http\Controllers\users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index() {
    $brands = Brand::all(); 
    return view('user.home', compact('brands'));
}
}
