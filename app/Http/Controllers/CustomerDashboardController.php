<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function MyProfile()
    {
        return view('customer.profile');
    }
    public function BookingHistory()
    {
        $data['orders'] = Order::orderBy('created_at','desc')->get();
        return view('customer.booking.index',$data);
    }


    public function BookingHistoryShow($id)
    {

        $order =Order::where('inv_id',$id)->first() ?: abort(404);
        $basket = Basket::where('id',$order->basket_id)->first();
        $cartItems = BasketItem::where('basket_id',$basket->id)->get();

//        $product = Product::with(['airport','provider'])->findorfail($basket->product_id);
        return view("customer.booking.show", compact('order','basket','cartItems'));
    }

    public function MyDrive(Request $request)
    {

        if($request->ajax()){
            $data['purchaseddrive'] = Basket::where('user_id', auth()->user()->id)
                ->leftJoin('basket_items', 'basket_items.basket_id', '=', 'baskets.id')

                // Conditional join for 'media'
                ->when('media', function ($query) {
                    $query->leftJoin('media', function($join) {
                        $join->on('basket_items.item_id', '=', 'media.id')
                            ->where('basket_items.item_type', '=', 'media');
                    });
                })

                // Conditional join for 'events'
                ->when('event', function ($query) {
                    $query->leftJoin('events', function($join) {
                        $join->on('basket_items.item_id', '=', 'events.id')
                            ->where('basket_items.item_type', '=', 'event');
                    });
                })

                // Conditional join for 'collections'
                ->when('collection', function ($query) {
                    $query->leftJoin('collections', function($join) {
                        $join->on('basket_items.item_id', '=', 'collections.id')
                            ->where('basket_items.item_type', '=', 'collection');
                    });
                })

                ->select('basket_items.*', 'media.file_path', 'events.name as event_name', 'collections.collection_name')

                // Order by 'item_type' with 'media' appearing last
                ->orderByRaw("FIELD(basket_items.item_type, 'media') ASC")

                ->paginate(10);

            return view('customer.drive.getList',$data);

        }
//dd($data);

//        BasketItem::leftJoin('baskets','basket_items.basket_id','baskets.id')
//        ->where('baskets');
        return view('customer.drive.index');
    }
    public function ChangePassword()
    {
        return view('customer.passwordchange');
    }

    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
