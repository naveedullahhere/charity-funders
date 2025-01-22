<?php

namespace App\Http\Controllers;

use App\Models\WorkArea;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WorkAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.workareas.index');
    }

    /**
     * Fetch and filter the list of work areas.
     */
    public function getList(Request $request)
    {
        $workAreas = WorkArea::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
            });
        })
            ->latest()
            ->paginate(request('per_page', 25));

        return view('management.workareas.getList', compact('workAreas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.workareas.create');
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

        $workArea = WorkArea::create($validatedData);

        return response()->json(['success' => 'Work area created successfully.', 'data' => $workArea], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkArea $workArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $workArea = WorkArea::findOrFail($id);
        return view('management.workareas.edit', compact('workArea'));
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
        $workArea = WorkArea::findOrFail($id);

        $workArea->update($request->all());

        return response()->json(['success' => 'Work area updated successfully.', 'data' => $workArea], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $workArea = WorkArea::findOrFail($id);

        $workArea->delete();

        return response()->json(['success' => 'Work area deleted successfully.'], 200);
    }

    /**
     * Select a specific work area for the user.
     */
    public function selectWorkArea(Request $request, $id = null)
    {
        if ($id) {
            $workArea = WorkArea::findOrFail($id);
            auth()
                ->user()
                ->update(['current_work_area_id' => $workArea->id]);
            return redirect('/');
        }
        $workAreas = WorkArea::get();
        return view('management.workareas.selectWorkArea', compact('workAreas'));
    }
}
