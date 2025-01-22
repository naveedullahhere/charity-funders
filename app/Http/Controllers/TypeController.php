<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.types.index');
    }

    /**
     * Fetch and filter the list of types.
     */
    public function getList(Request $request)
    {
        
        $types = Type::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
            });
        })
            ->latest()
            ->paginate(request('per_page', 25));

        return view('management.types.getList', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $type = Type::create($validatedData);

        return response()->json(['success' => 'Type created successfully.', 'data' => $type], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return view('management.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|integer',
        ]);

        $type = Type::findOrFail($id);

        $type->update($validatedData);

        return response()->json(['success' => 'Type updated successfully.', 'data' => $type], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $type = Type::findOrFail($id);
        $type->delete();

        return response()->json(['success' => 'Type deleted successfully.'], 200);
    }
}
