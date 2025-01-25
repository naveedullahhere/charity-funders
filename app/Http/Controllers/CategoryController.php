<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\CategoryRequest;
use App\Models\Type;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.category.index');
    }

    /**
     * Get list of categories.
     */
    public function getList(Request $request)
    {
        $categories = Category::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
            });
        })
            ->with('parent') // Eager load parent category
            ->latest()
            ->paginate(request('per_page', 25));

        return view('management.category.getList', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('management.category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return response()->json(['success' => 'Category created successfully.', 'data' => $category], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
       
        $categories = Category::where('id', '!=', $id)->get(); // Exclude current category from parent list
        return view('management.category.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response()->json(['success' => 'Category updated successfully.', 'data' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.'], 200);
    }
}
