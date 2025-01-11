<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Page;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AirportController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:airport-list', ['only' => ['index']]);
        $this->middleware('permission:airport-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:airport-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:airport-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airport = Airport::get();
        return view('management.airports.index',compact('airport'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.airports.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
            'title' => 'required|string|max:255',
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
            $contact = Airport::create($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.','data' => $contact]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Airport $airport)
    {
        return view('management.airports.edit',compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        $validator = Validator::make($request->all(), [
            // Define your validation rules here
            'title' => 'required|string|max:255',
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
            $contact =$airport->update($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.','data' => $contact]);
    }
    public function destroy(Airport $airport)
    {
        DB::beginTransaction();
        try {
            $airport = $airport->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $airport]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function getTable(Request $request)
    {
        $airports = Airport::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('title', 'like', $searchTerm)
                    ->orWhere('description', 'like', $searchTerm);

            });
        })->latest()->paginate(10);

        return view('management.airports.getList', compact('airports'));


    }



    public function exportToExcel()
    {
        $discounts = Airport::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'title');
        $sheet->setCellValue('B1', 'slug');
        $sheet->setCellValue('C1', 'description');
        $sheet->setCellValue('D1', 'status');
        $sheet->setCellValue('E1', 'meta title');
        $sheet->setCellValue('F1', 'meta description');
        $sheet->setCellValue('G1', 'meta keyword');
        $sheet->setCellValue('H1', 'created at');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->title);
            $sheet->setCellValue('B' . $row, $discount->slug);
            $sheet->setCellValue('C' . $row, $discount->description);
            $sheet->setCellValue('D' . $row, $discount->status);
            $sheet->setCellValue('E' . $row, $discount->meta_title);
            $sheet->setCellValue('F' . $row, $discount->meta_description);
            $sheet->setCellValue('G' . $row, $discount->meta_keyword);
            $sheet->setCellValue('H' . $row, date('D d M Y', strtotime($discount->created_at)));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'airports.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

}
