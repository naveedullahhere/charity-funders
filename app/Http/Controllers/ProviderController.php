<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Provider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.providers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management.providers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
            // Get the file from the request
            $logoFile = $request->file('logo');
            $path = NULL;

            if ($logoFile) {
                $path = $logoFile->store('/');
            }

            $request = $request->all();
            $request['logo'] = $path;

            $provider = Provider::create($request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $provider]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        return view('management.providers.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
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
            $logoFile = $request->file('logo');
            $path = $request->logo ?? $provider->logo;

            if ($logoFile) {
                $path = $logoFile->store('/');
            }

            $request = $request->all();
            $request['logo'] = $path;

            $provider = $provider->update($request);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Saved.', 'data' => $provider]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        DB::beginTransaction();
        try {
            $provider = $provider->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $provider]);
    }

    public function getTable(Request $request)
    {
        $providers = Provider::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('title', 'like', $searchTerm);
            });
        })->latest()->paginate(10);

        return view('management.providers.getList', compact('providers'));
    }

    public function exportToExcel()
    {
        $discounts = Provider::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'title');
        $sheet->setCellValue('B1', 'phone');
        $sheet->setCellValue('C1', 'email');
        $sheet->setCellValue('D1', 'address');
        $sheet->setCellValue('E1', 'description');
        $sheet->setCellValue('F1', 'created at');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->title);
            $sheet->setCellValue('B' . $row, $discount->phone);
            $sheet->setCellValue('C' . $row, $discount->email);
            $sheet->setCellValue('D' . $row, $discount->address);
            $sheet->setCellValue('E' . $row, $discount->description);
            $sheet->setCellValue('F' . $row, date('D d M Y', strtotime($discount->created_at)));

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'providers.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
