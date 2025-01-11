<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Page;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Exception;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:type-list', ['only' => ['index']]);
        $this->middleware('permission:type-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:type-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:type-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $spaces = Space::get();
        return view('management.spaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.spaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();
        try {
            $request = $request->all();
            $contact = Space::create($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $contact]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Space $space)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Space $space)
    {
        return view('management.spaces.edit', compact('space'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Space $space)
    {
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'error',
                'message' => 'error',
                'error' => $validator->errors()
            ]);
        }
        DB::beginTransaction();
        try {
            $request['created_at'] = auth()->user()->id;
            $request = $request->all();
            $contact = $space->update($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $contact]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Space $space)
    {
        DB::beginTransaction();
        try {
            $space = $space->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $space]);
    }

    public function getTable(Request $request)
    {
        $spaces = Space::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
            });
        })->latest()->paginate(10);

        return view('management.spaces.getList', compact('spaces'));
    }


    public function exportToExcel()
    {
        $discounts = Space::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'name');
        $sheet->setCellValue('B1', 'description');
        $sheet->setCellValue('C1', 'status');
        $sheet->setCellValue('D1', 'created at');


        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->name);
            $sheet->setCellValue('B' . $row, $discount->description);
            $sheet->setCellValue('C' . $row, $discount->status);
            $sheet->setCellValue('D' . $row, date('D d M Y', strtotime($discount->created_at)));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'spaces.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

}
