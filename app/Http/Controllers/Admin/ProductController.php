<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $this->authorize('view-any' , Product::class);
        $products = Product::with('category')->orderBy('id' , 'desc')->paginate(5);
        return view('cms.product.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('products.create');
        // if(!Gate::allows('products.create')){
        //     abort(403);
        // }
        $this->authorize('create' , Product::class);
        $products = new Product();
        $categories = Category::where('status', '=' , 'active')->get();
        return view('cms.product.create' , compact('products' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->authorize('create' , Product::class);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        Product::create([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'price'=> $request->get('price'),
            'sale_price'=> $request->get('sale_price'),
            'quantity'=> $request->get('quantity'),
            'sku' => $request->get('sku'),
            'weight'=> $request->get('weight'),
            'width'=>$request->get('width'),
            'height'=>$request->get('height'),
            'length'=>$request->get('length'),
            'image'=> $image ?? " " ,
            'admin_data' => auth()->user(),
            'user_id' => auth()->user()->id,
        ]);
        // if($request->hasFile('image')){
        //     $image = $request->file('image');
        //     $imageName = time() . 'image.' . $image->getClientOriginalExtension();
        //     $src = $image->move('storage/images/product' , $imageName);
        // }
        // $request->merge([
        //     'slug' => Str::slug($request->get('name')),
        //     'image'=> $src ,
        // ]);
        // $requests = $request->all();
        // $products = Product::create($requests);
        // dd($products);
        return redirect(route('products.index'))->with('success' , 'Product created is done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('view' , $products);
        return view('cms.product.show' , compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('update' , $products);
        $categories = Category::where('status', '=' , 'active')->get();
        return view('cms.product.edit' , compact('products' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $products = Product::findOrFail($id);
        $this->authorize('update' , $products);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        $products->update([
            'name' => $request->get('name'),
            'category_id' => $request->get('category_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'price'=> $request->get('price'),
            'sale_price'=> $request->get('sale_price'),
            'quantity'=> $request->get('quantity'),
            'sku' => $request->get('sku'),
            'weight'=> $request->get('weight'),
            'width'=>$request->get('width'),
            'height'=>$request->get('height'),
            'length'=>$request->get('length'),
            'image'=> $image ?? " " ,
            'admin_data' => auth()->user(),
            'user_id' => auth()->user()->id,
        ]);
        return redirect(route('products.index'))->with('success' , 'Product Updated is done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Gate::authorize('products.delete');
        // if(!Gate::allows('products.delete')){
        //     abort(403);
        // }
        $products=Product::findOrFail($id);
        $this->authorize('delete' , $products);
        $products->delete();
        return redirect(route('products.index'))->with('success' , 'Product Deleted is done');
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->paginate(5);
        return view('cms.product.trash' , compact('products'));
    }
    public function restore($id)
    {
        $products = Product::onlyTrashed()->findOrFail($id);
        $products->restore();
        return redirect(route('products.index'))->with('success' , 'Product Restored is done');
    }
    public function restoreAll()
    {
        $products = Product::onlyTrashed()->restore();
        return redirect(route('products.index'))->with('success' , 'Products Restored is done');
    }
    public function forceDelete($id)
    {
        $products = Product::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete' , $products);
        $products->forceDelete();
        return redirect(route('products.trash'))->with('success' , 'Product Deleted is done');
    }
    public function deleteAll()
    {
        $products = Product::onlyTrashed()->forceDelete();
        return redirect(route('products.trash'))->with('success' , 'Products Deleted is done');
    }
}

