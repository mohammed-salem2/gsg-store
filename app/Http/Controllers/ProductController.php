<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $products = [
        'Wathces' =>200 ,
        'Mobiles'=> 120,
        'Laptobs'=>450,
    ];
    public function index()
    {
        return $this->products;
    }

    public function show(string $slug)
    {
        $product = Product::where('slug' , '=' , $slug)->firstOrFail();
        return view('front.products.show' , compact('product'));
    }
}
