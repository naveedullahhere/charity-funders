<?php

// app/Http/Controllers/NewsletterController.php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Models\NewsletterSubscriber;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        NewsletterSubscriber::create([
            'email' => $request->email,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing to our newsletter!',
        ]);
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
