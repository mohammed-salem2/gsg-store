<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view-any' , Category::class);
        $categories=Category::withCount('products')->orderBy('id' , 'desc')->paginate(5);
        // $categories = Category::where('status' ,'=','active')
        // ->orderBy('name' , 'asc')
        // ->get();// الفرق بين الجيت و الاول هو انه الجيت بستخدمها لما ادخل على كويري بليدر اما الاول ستخدمها على نظام المودل
        // $categories=Category::leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        // ->select([
        //     'categories.*',
        //     'parents.name as parent_name'
        // ])->withCount('products')
        // ->orderBy('categories.id' , 'desc')
        // ->paginate(5);
        return view('cms.category.index' , compact('categories'));  // الكومبكت بترجع اراي
        // return view('cms.category.index' , [
        //     'categories' => $categories ,
        // ]); // الطريقة التانية عشان امرر الباراميتر لصفحة الفيو
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create' , Category::class);
        $parents = Category::where('status' , '=' , 'active')->orderBy('name' , 'asc')->get();
        $categories = new Category();
        return view('cms.category.create' , compact('categories' , 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->authorize('create' , Category::class);
        // $clean = $request->validate([
        //     'name' => 'required|string|max:255|min:3|unique:categories,name',
        //     'parent_id'=>'nullable|int|exists:categories,id',
        //     'description'=>'nullable|min:5',
        //     'status'=>'required|in:active,draft',
        //     'image'=>'image|max:512000|dimensions:min_width=300,min_height=300', // هان الحجم بكون بالبايت يعني 1024 بايت بتساوي 1 كيلو
        // ]);
        // Method 2
        // $rules = [
        //     'name' => 'required|string|max:255|min:3|unique:categories,name',
        //     'parent_id'=>'nullable|int|exists:categories,id',
        //     'description'=>'nullable|min:5',
        //     'status'=>'required|in:active,draft',
        //     'image'=>'image|max:512000|dimensions:min_width=300,min_height=300',
        // ];
        // $clean=$this->validate($request , $rules);
        // $request->merge([
        //     'slug'=>Str::slug($request->get('name')),
        // ]);
        // $categories = Category::create($request->all());
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        Category::create([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'image'=> $image ?? " " ,
            'admin_data' => auth()->user(),
        ]);
        return redirect(route('categories.index'))->with('success' , 'Category Created is done');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories=Category::leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])->findOrFail($id);
        return view('cms.category.show' , compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::findOrFail($id);
        $this->authorize('update' , $categories);
        $parents = Category::where('id' , '<>' , $categories->id)->where('status' , '=' ,'active')->get();
        return view('cms.category.edit' , compact('categories' , 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $categories = Category::findOrFail($id);
        $this->authorize('update' , $categories);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        else {
            $image = $categories->image;
        }
        $categories->update([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'image'=> $image ?? null ,
            'admin_data' => auth()->user(),
        ]);
        return redirect(route('categories.index'))->with('success' , 'Category Updated is done');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $this->authorize('delete' , $categories);
        $categories->delete();
        return redirect(route('categories.index'))->with('success' , 'Category Deleted is done');
    }

    public function trash()
    {
        $categories=Category::leftJoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        ->select([
            'categories.*',
            'parents.name as parent_name'
        ])->onlyTrashed()
        ->orderBy('categories.id' , 'desc')
        ->paginate(5);
        // $categories = Category::onlyTrashed()->paginate(5);
        return view('cms.category.trash' , compact('categories'));
    }
    public function restore($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect(route('categories.index'))->with('success' , 'Category Restored is done');
    }
    public function restoreAll()
    {
        $categories = Category::onlyTrashed()->restore();
        return redirect(route('categories.index'))->with('success' , 'Category Restored is done');
    }
    public function forceDelete($id)
    {
        $categories = Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect(route('categories.trash'))->with('success' , 'Categories Deleted is done');
    }
    public function deleteAll()
    {
        $categories = Category::onlyTrashed()->forceDelete();
        return redirect(route('categories.trash'))->with('success' , 'Categories Deleted is done');
    }
}
