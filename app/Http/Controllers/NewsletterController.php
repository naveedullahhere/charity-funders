<?php

// app/Http/Controllers/NewsletterController.php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class NewsletterController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:newsletter-list', ['only' => ['index']]);
    }

    public function index()
    {

        $newsletters = Newsletter::get();
        return view('management.newsletter.index', compact('newsletters'));
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:newsletters,email',
        ]);

        Newsletter::create($request->only('name', 'email'));

        return response()->json(['success' => 'You have been successfully subscribed to our newsletter!']);
    }

    public function getTable(Request $request)
    {
        $newsletters = Newsletter::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        })->latest()->paginate(10);

        return view('management.newsletter.getList', compact('newsletters'));
    }




    public function exportToExcel()
    {
        $discounts = Newsletter::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'name');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'created at');


        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->name);
            $sheet->setCellValue('B' . $row, $discount->email);
            $sheet->setCellValue('C' . $row, date('D d M Y', strtotime($discount->created_at)));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'newsletters.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }

}
