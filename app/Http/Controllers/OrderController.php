<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Discount;
use App\Models\Order;
use App\Helpers\CommonHelper;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



class OrderController extends Controller
{



    function __construct()
    {
        $this->middleware('permission:bookings-list', ['only' => ['index']]);
        $this->middleware('permission:bookings-delete', ['only' => ['destroy']]);
    }




    public function exportUsersToExcel()
    {
        $orders = Order::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Order ID');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Name');
        $sheet->setCellValue('D1', 'Phone no');
        $sheet->setCellValue('E1', 'Vehicle Registration');
        $sheet->setCellValue('F1', 'Vehicle Model');
        $sheet->setCellValue('G1', 'Vehicle Color');
        $sheet->setCellValue('H1', 'Passenger');
        $sheet->setCellValue('I1', 'Terminal Out');
        $sheet->setCellValue('J1', 'Terminal In');
        $sheet->setCellValue('K1', 'Flight Out');
        $sheet->setCellValue('L1', 'Flight In');
        $sheet->setCellValue('M1', 'Amount');
        $sheet->setCellValue('N1', 'Discount');
        $sheet->setCellValue('O1', 'Discount Code');
        $sheet->setCellValue('P1', 'Booking Date');
        $sheet->setCellValue('Q1', 'Product');
        $sheet->setCellValue('R1', 'Arrival Date');
        $sheet->setCellValue('S1', 'Return Date');

        $row = 2;
        foreach ($orders as $order) {
            $basket = Basket::where('uniq_id', $order->basket_id)->first();
            $sheet->setCellValue('A' . $row, $order->id);
            $sheet->setCellValue('B' . $row, $order->email);
            $sheet->setCellValue('C' . $row, $order->lead_title . ' ' . $order->lead_first_name . ' ' . $order->lead_last_name);
            $sheet->setCellValue('D' . $row, $order->lead_phone);
            $sheet->setCellValue('E' . $row, $order->vehicle_registration);
            $sheet->setCellValue('F' . $row, $order->vehicle_model);
            $sheet->setCellValue('G' . $row, $order->vehicle_color);
            $sheet->setCellValue('H' . $row, $order->passenger);
            $sheet->setCellValue('I' . $row, $order->terminal_out);
            $sheet->setCellValue('J' . $row, $order->terminal_in);
            $sheet->setCellValue('K' . $row, $order->flight_out);
            $sheet->setCellValue('L' . $row, $order->flight_in);
            $sheet->setCellValue('M' . $row, $order->product_price);
            $sheet->setCellValue('N' . $row, $order->discount_percentage);
            $sheet->setCellValue('O' . $row, $order->discount_code);
            $sheet->setCellValue('P' . $row, date('D d M Y', strtotime($order->created_at)));
            $sheet->setCellValue('Q' . $row, htmlspecialchars(CommonHelper::getFirstColumn('products', 'title', $basket->product_id)));
            $sheet->setCellValue('R' . $row, $basket->arrival_date);
            $sheet->setCellValue('S' . $row, $basket->return_date);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'bookings.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("management.orders.index");
    }
    public function getTable(Request $request)
    {
        $orders = Order::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('id', 'like', $searchTerm);
                $sq->orWhere('email', 'like', $searchTerm);
                $sq->orWhere('lead_first_name', 'like', $searchTerm);
                $sq->orWhere('lead_last_name', 'like', $searchTerm);
            });
        })->latest()->paginate(10);
        return view('management.orders.getList', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $order = Order::findorfail($id);
        $basket = Basket::where('uniq_id', $order->basket_id)->first();
        $product = DB::table('products')->where('id', $basket->product_id)->first();
        return view("management.orders.show", compact('order', 'basket', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order= Order::findorfail($id);
        $basket = Basket::where('uniq_id',$order->basket_id)->first();
        $data['order'] = $order;
        $data['basket'] = $basket;
        return view("management.orders.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $order = Order::findorfail($id);
//        dd($order);
        $order->update($request->all());
        Basket::where('uniq_id',$order->basket_id)->update([
            'arrival_date'=>$request->arrival_date,
            'return_date'=>$request->return_date
        ]);

        $req['booking'] = $order;

        Mail::send('email.updatebooking',$req ,  function ($message) use ($order) {
            $message->to($order->email)
                ->subject('Welcome to '.config('app.name'));
        });
        return response()->json(['success' => 'Successfully Saved.', 'data' => $order]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $discount = $order->first()->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $discount]);
    }
    public function thanks($inv_id)
    {


//        if ($basket->status === 0) {
//            abort(403, 'Basket already bought.');
//        }





        $order = Order::where("inv_id", $inv_id)->latest()->first() ?? abort(404);

        $basket = Basket::where('id', $order->basket_id)->first();

        $cartItems = BasketItem::where('basket_id',$basket->id)->get();
        return view("frontend.order.thanks", ["inv_id" => $inv_id, "order" => $order, "basket" => $basket, "cartItems" => $cartItems]);
    }

    // In your controller or any appropriate class
    public static function getDaysDifference($startDate, $endDate)
    {
        // Convert the dates to DateTime objects
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        // Calculate the difference between the dates
        $interval = $start->diff($end);

        // Return the difference in days
        return $interval->days;
    }

    public function checkout(Request $request, $unique_id)
    {
        $basket = Basket::where("uniq_id", $unique_id)->where('status', 0)->latest()->first() ?? abort(404);
        $productId = $basket->product_id;
        $product = Product::with(["airport", "provider", "space"])->findOrFail($productId);
        return view("frontend.order.checkout", ['product' => $product, "basket" => $basket]);
    }
    public function checkCouponCode(Request $request)
    {
        $productPrice = $request->product_price ?? null;



        $basketID = $request->basket_id ?? null;
        $couponCode = $request->code ?? null;
        $action = $request->action;
        // dd($couponCode);

        if ($action == "RENDER" || $action == "REMOVE") {
            if ($action == "REMOVE") {
                Basket::where("uniq_id", $basketID)->update([
                    "discount_code" => NULL,
                    "discount_percentage" => NULL,
                ]);
            }

            $basket = Basket::where("uniq_id", $basketID)->first();

            return view("frontend.order.discount", ["basket" => $basket, "price" => $productPrice]);
        }

        if ($action == "COUPON" && $couponCode) {
            $discount = Discount::where('discount_code', $couponCode)->first();

            if ($discount) {
                Basket::where("uniq_id", $basketID)->update([
                    "discount_code" => $discount->discount_code,
                    "discount_percentage" => $discount->discount_percentage,
                ]);

                $basket = Basket::where("uniq_id", $basketID)->first();

                return view("frontend.order.discount", ["discount" => $discount, "basket" => $basket, "price" => $productPrice]);
            } else {
                return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
            }
        }
    }

    public function addToCart(Request $request)
    {
        $productId = $request->query('product_id');
        $arrivalDate = $request->query('arrival_date');
        $returnDate = $request->query('return_date');
        $productPrice = $request->query('product_price') ?? 0;

        $uniqId = uniqid();

        $daysDiff = $this->getDaysDifference($arrivalDate, $returnDate);
        $daysDiff = $daysDiff != 0 ? $daysDiff : 1;
        $product = Product::with(["airport", "provider", "space"])->findOrFail($productId);

        $price = $productPrice;
        $price = ((int)$price);

        $basketData = [
            'uniq_id' => $uniqId,
            'product_id' => $product->id ?? null,
            'product_price' => $price,
            'arrival_date' => $arrivalDate ?? null,
            'return_date' => $returnDate ?? null,
        ];
        Basket::create($basketData);

        return redirect()->route('checkout', ['unique_id' => $uniqId]);
    }
}
