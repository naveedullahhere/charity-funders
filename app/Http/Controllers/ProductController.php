<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Airport;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:product-list', ['only' => ['index']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('management.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $providers = Provider::where('status', 1)->select("id", "title")->get();
        $airports = Airport::where('status', 1)->select("id", "title")->get();
        $spaces = Space::where('status', 1)->select("id", "name")->get();

        return view('management.product.create', compact("providers", "airports", "spaces"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Product::validateData($request->all());
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
            $contact = Product::create($request);
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
    public function show($id)
    {
        $product = Product::findorfail($id);
        $providers = Provider::select("id", "title")->get();
        $airports = Airport::select("id", "title")->get();
        $spaces = Space::select("id", "name")->get();

        return view('management.product.show', compact('product', "providers", "airports", "spaces"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $providers = Provider::where('status', 1)->select("id", "title")->get();
        $airports = Airport::where('status', 1)->select("id", "title")->get();
        $spaces = Space::where('status', 1)->select("id", "name")->get();

        return view('management.product.edit', compact('product', "providers", "airports", "spaces"));
    }

    public function dailyPrice(Request $request, Product $id)
    {
        $product = $id;
        return view('management.product.dailyPrices', compact('product'));
    }

    public function updateDailyPrices(Request $request, $id)
    {

        $validatedData = $request->validate([
            'prices' => ['required', 'array', 'size:30'],
            'prices.*' => 'numeric',
            'additional_charge' => 'nullable|numeric',
        ]);

        try {
            $product = Product::findOrFail($id);

            $product->prices = json_encode($validatedData['prices']);

            if (isset($validatedData['additional_charge'])) {
                $product->additional_charge = $validatedData['additional_charge'];
            }

            $product->save();

        return response()->json(['success' => 'Successfully Saved.', 'data' => $product]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Product::validateData($request->all());
        if ($validator->fails()) {
            return response()->json([
                'success' => 'error',
                'message' => 'error',
                'error' => $validator->errors()
            ]);
        }

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
            $request["transfer_required"] = isset($request["transfer_required"]) ? 1 : 0;
            $contact = $product->update($request);
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
    public function destroy(Product $product)
    {
        DB::beginTransaction();
        try {
            $contact = $product->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $contact]);
    }

    public function addProductOnLead()
    {
        return view('management.product.addProductOnLead');
    }
    public function getTable(Request $request)
    {
        $products = Product::with(["airport", "provider", "space"])
            ->when($request->filled('search'), function ($q) use ($request) {
                $searchTerm = '%' . $request->search . '%';
                return $q->where(function ($sq) use ($searchTerm) {
                    $sq->where('title', 'like', $searchTerm)
                        ->orwhere('price', 'like', $searchTerm)
                        ->orWhereHas('airport', function ($subQuery) use ($searchTerm) {
                            $subQuery->where('title', 'like', $searchTerm);
                        })
                        ->orWhereHas('provider', function ($subQuery) use ($searchTerm) {
                            $subQuery->where('title', 'like', $searchTerm);
                        })
                        ->orWhereHas('space', function ($subQuery) use ($searchTerm) {
                            $subQuery->where('name', 'like', $searchTerm);
                        });
                });
            })
            ->latest()
            ->paginate(10);


        return view('management.product.getList', compact('products'));
    }

    public function getProducts(Request $request)
    {

        $airportSlug = $request->query('airport');
        $arrival_date = $request->query('arrival_date');
        $return_date = $request->query('return_date');
        $passengers = $request->query('passengers');
        $error = "";

        if (!$airportSlug || !$arrival_date || !$return_date) {
            $error = "Invalid Parameters!";
            return view('frontend.products.search', compact('error'));
        }

        $products = Product::with(["airport", "provider", "space"])
            ->join('airports', 'products.airport_id', '=', 'airports.id')
            ->join('spaces', 'products.space_id', '=', 'spaces.id') // Assuming 'space_id' is the foreign key in the products table
            ->join('providers', 'products.provider_id', '=', 'providers.id') // Assuming 'provider_id' is the foreign key in the products table
            ->where('spaces.status', 1)
            ->where('providers.status', 1)
            ->where('airports.status', 1)
            ->where('products.status', 1)
            ->where('airports.slug', '=', $airportSlug)
            ->select('products.*', 'airports.*', 'spaces.*', 'providers.*', 'products.id as product_id', 'products.title as product_title')
            ->latest('products.created_at')
            ->get();

        $products = $products->filter(function ($product) {
            return isset($product->prices) && is_array(json_decode($product->prices, true)) && count(json_decode($product->prices, true)) === 30;
        });

        $daysDiff = OrderController::getDaysDifference($arrival_date, $return_date) + 1;

        foreach ($products as &$product) {
            if (isset($product->prices) && is_array(json_decode($product->prices, true))) {

                $prices = json_decode($product->prices, true);

                if (array_key_exists($daysDiff, $prices)) {
                    $product->price = $prices[$daysDiff];
                } else {
                    $product->price = $product->additional_charge * $daysDiff;
                }
            }
        }

        if (!count($products)) {
            $error = "No product was found!";
        }

        return view('frontend.products.search', compact('products', 'airportSlug', 'error', 'arrival_date', 'return_date', 'passengers'));
    }



    public function exportToExcel()
    {
        $discounts = Product::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'title');
        $sheet->setCellValue('B1', 'airport');
        $sheet->setCellValue('C1', 'provider');
        $sheet->setCellValue('D1', 'type');
        $sheet->setCellValue('E1', 'description');
        $sheet->setCellValue('F1', 'status');
        $sheet->setCellValue('G1', 'created at');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->title);
            $sheet->setCellValue('B' . $row, htmlspecialchars(CommonHelper::getFirstColumn('airports', 'title', $discount->airport_id)));
            $sheet->setCellValue('C' . $row, htmlspecialchars(CommonHelper::getFirstColumn('providers', 'title', $discount->provider_id)));
            $sheet->setCellValue('D' . $row, htmlspecialchars(CommonHelper::getFirstColumn('spaces', 'name', $discount->space_id)));
            $sheet->setCellValue('E' . $row, $discount->long_description);
            $sheet->setCellValue('F' . $row, $discount->status);
              $sheet->setCellValue('G' . $row, date('D d M Y', strtotime($discount->created_at)));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'products.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }


}
