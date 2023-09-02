<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')->orderBy('id' , 'desc')->paginate(5);
        $data = CategoryResource::collection($categories);
        $pagination = [
            'current_page' => $categories->currentPage(),
            'last_page' => $categories->lastPage(),
            'per_page' => $categories->perPage(),
            'total' => $categories->total(),
            'next_page_url' => $categories->nextPageUrl(),
            'prev_page_url' => $categories->previousPageUrl(),
        ];
        $code = 200 ;

        return response()->json([
            'code' => $code ,
            'data' => $data ,
            'pagination' => $pagination,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        $categories = Category::create([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'image'=> $image ?? " " ,
            // 'admin_data' => auth()->user(),
        ]);

        return response()->json($categories , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::findOrFail($id);
        return response()->json([
            'code' => 200 ,
            'data' => new CategoryResource($categories) ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $categories = Category::findOrFail($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image = $file->store('uploads' , [
                'disk' => 'public',
            ]);
        }
        $categories->update([
            'name' => $request->get('name'),
            'parent_id' => $request->get('parent_id'),
            'slug' => Str::slug($request->get('name')),
            'status'=> $request->get('status'),
            'description' => $request->get('description'),
            'image'=> $image ?? " " ,
            // 'admin_data' => auth()->user(),
        ]);

        return response()->json([
            'message' => 'Category updated' ,
            'category' => $categories ,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return response()->json([
            'code' => 200,
            'message' => 'Category Deleted' ,
        ]);
    }
}
