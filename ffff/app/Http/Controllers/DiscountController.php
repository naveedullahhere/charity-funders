<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Basket;
use App\Models\Discount;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DiscountController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:discount-list', ['only' => ['index']]);
        $this->middleware('permission:discount-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:discount-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:discount-delete', ['only' => ['destroy']]);
    }


    public function exportToExcel()
    {
        $discounts = Discount::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Code');
        $sheet->setCellValue('B1', 'Percentage');
        $sheet->setCellValue('C1', 'Status');
        $sheet->setCellValue('D1', 'Created Date');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->discount_code);
            $sheet->setCellValue('B' . $row, $discount->discount_percentage);
            $sheet->setCellValue('C' . $row, $discount->status);
            $sheet->setCellValue('D' . $row, date('D d M Y', strtotime($discount->created_at)));

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'discounts.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount_code' => 'required|string|max:255',
            'discount_percentage' => 'required|string|max:255',
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
            $discount = Discount::create($request->all());

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $discount]);
    }

    /**
     * Display the specified resource.
     */
    public function show(discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('management.discounts.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        $validator = Validator::make($request->all(), [
            'discount_code' => 'required|string|max:255',
            'discount_percentage' => 'required|string|max:255',
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
            $discount = $discount->update($request->all());

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $discount]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        DB::beginTransaction();
        try {
            $discount = $discount->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $discount]);
    }

    public function getTable(Request $request)
    {
        $discounts = Discount::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('discount_code', 'like', $searchTerm);
            });
        })->latest()->paginate(10);

        return view('management.discounts.getList', compact('discounts'));
    }
}
