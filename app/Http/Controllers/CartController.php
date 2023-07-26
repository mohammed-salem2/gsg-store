<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /* @var \App\Repositories\Cart\CartRepository*/
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    public function index()
    {
        $cart = $this->cart->all();
        $total = $this->cart->total();
        return view('front.cart.cart' , compact('cart' , 'total'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required','exists:products,id'],
            'quantity' => ['int' , 'min:1' , function($attr , $value , $fail){
                $id = request()->input('product_id');
                $product = Product::findOrFail($id);
                if($value > $product->quantity){
                    $fail(__('Quantity greater than quantity in stock.'));
                }
            }],
        ]);
        $cart =  $this->cart->add($request->post('product_id') , $request->post('quantity' , 1));
        return redirect()->back()->with('success' , __('Product added to cart!'));
    }
}
