<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Page;
use App\Models\Department;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:page-list', ['only' => ['index']]);
        $this->middleware('permission:page-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:page-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:page-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $pages = Page::get();
        return view('management.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.pages.create');

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
            $contact = Page::create($request);
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
    public function show(Page $page)
    {
        return view('management.pages.show',compact('page'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('management.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        if($request->ajax()){
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
                $request = $request->all();
                $contact =$page->update($request);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()]);
            }
            return response()->json(['success' => 'Successfully Saved.','data' => $contact]);
        }
        try {
            $request = $request->all();
            $contact =$page->update($request);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        DB::beginTransaction();
        try {
            $contact = $page->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.','data' => $contact]);

    }
    public function getTable(Request $request)
    {
        $pages = Page::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('title', 'like', $searchTerm);

            });
        })->latest()->paginate(10);

        return view('management.pages.getList', compact('pages'));


    }


    public function exportToExcel()
    {
        $discounts = Page::all();

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
        $fileName = 'pages.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

}
