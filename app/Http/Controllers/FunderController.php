<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funder;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Funder\FunderRequest;

class FunderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.funder.index');
    }

    /**
     * Get list of funders.
     */
    public function getList(Request $request)
    {
        $funders = Funder::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm)
                   ->orWhere('charity_no', 'like', $searchTerm);
            });
        })
        ->latest()
        ->paginate(request('per_page', 25));

        return view('management.funder.getList', compact('funders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.funder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FunderRequest $request)
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $funder = Funder::create($data);

        return response()->json(['success' => 'Funder created successfully.', 'data' => $funder], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $funder = Funder::findOrFail($id);
        return view('management.funder.edit', compact('funder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FunderRequest $request, Funder $funder): JsonResponse
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $funder->update($data);

        return response()->json(['success' => 'Funder updated successfully.', 'data' => $funder], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funder $funder): JsonResponse
    {
        $funder->delete();
        return response()->json(['success' => 'Funder deleted successfully.'], 200);
    }
}