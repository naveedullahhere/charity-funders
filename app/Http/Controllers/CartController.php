<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    public function index(Request $request) {}

    public function showCart()
    {
        $basket = Basket::where('user_id', auth()->user()->id)->where("status", 1)->first();

        if ($basket != null && $basket->status === 1) {
            $cartItems = BasketItem::where('basket_id', $basket->id)->get();
            $totalPrice = $cartItems->sum(function ($item) {
                return $item->price;
            });
        } else {
            $cartItems = [];
            $totalPrice = 0;
        }

        return view('frontend.pages.cart.index', compact('cartItems', 'totalPrice','basket'));
    }

    public function removeItem($itemId)
    {
        $basketItem = BasketItem::find($itemId);

        if ($basketItem) {
            $basketItem->delete();

            // Recalculate total price after deletion
            $newTotal = BasketItem::where('basket_id', auth()->user()->basket->id)
                ->sum(DB::raw('price'));

            // Recalculate item count after deletion
            $itemCount = BasketItem::where('basket_id', auth()->user()->basket->id)->count();

            return response()->json([
                'success' => true,
                'newTotal' => $newTotal,
                'itemCount' => $itemCount, // Return updated item count
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Item not found',
        ], 404);
    }

    public function createBasket(Request $request)
    {
        $basket = Basket::create([
            'uniq_id' => uniqid(), // Generate a unique ID
            'user_id' => auth()->id(), // Assuming user is authenticated
        ]);

        return response()->json($basket);
    }

    public function _addToBasket(Request $request)
    {
        $request->validate([
            'basket_id' => 'required|exists:baskets,id',
            'event_id' => 'nullable|exists:events,id',
            'media_id' => 'nullable|exists:media,id',
            'collection_id' => 'nullable|exists:collections,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = BasketItem::create([
            'basket_id' => $request->basket_id,
            'event_id' => $request->event_id,
            'media_id' => $request->media_id,
            'collection_id' => $request->collection_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json($item);
    }

    public function addToBasket(Request $request)
    {
        $userId = auth()->id(); // get user id if logged in
        $uniqId = $request->uniq_id;
        $quality = strtolower($request->quality ?? 'standard');

        // Check if the cart exists or create a new one
        $basket = Basket::where('uniq_id', $uniqId)
            ->orWhere('user_id', $userId)
            ->where('status', 1)
            ->first();

        if (!$basket) {
            $basket = Basket::create([
                'uniq_id' => $uniqId ?? uniqid(),
                'user_id' => $userId,
            ]);
        }

        // Add item to basket
        $itemType = $request->input('item_type'); // 'event', 'media', 'collection'
        $itemId = $request->input('item_id');
        $price = $request->input('price');

        // Create the basket item and capture the model
        $basketItem = $basket->items()->create([
            'item_id' => $itemId,
            'item_type' => $itemType,
            'price' => $price,
            'quantity' => $request->quantity ?? 1,
            'quality' => $quality
        ]);

        // Update the basket count
        $itemCount = $basket->items->count();

        return response()->json([
            'success' => true,
            'itemCount' => $itemCount,
            'basketItemId' => $basketItem->id, // return the newly added item's ID
        ]);
    }

    public function checkout($uniq_id)
    {

        $basket = Basket::where('uniq_id', $uniq_id)->where("status", 1)->firstorfail();

//        if ($basket->status === 0) {
//            abort(403, 'Basket already bought.');
//        }

        $cartItems = BasketItem::where('basket_id',$basket->id)->get();
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->price;
        });

        $basketId = $uniq_id;

        return view('frontend.order.checkout', compact('cartItems', 'totalPrice', 'basketId'));
    }

    public function processCheckout(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'payment_method' => 'required|in:COD,CARD',
        ]);

        try {
            $basket = Basket::where('uniq_id', $request->basketId)->first();

            $cartItems = $basket->items;
            $totalPrice = $cartItems->sum('price');

            $email = $request->email ?? null;
            $first_name = $request->first_name ?? null;
            $last_name = $request->last_name ?? null;
            $phone = $request->phone_no ?? null;
            $address = $request->address ?? null;
            $city = $request->city ?? null;
            $state = $request->state ?? null;
            $zip = $request->zip ?? null;
            $payment_method = $request->payment_method ?? null;
            $status = "pending";
            $payment_status = $request->payment_status ?? null;
            $transaction_key = $request->transaction_key ?? null;
            $transaction_url = $request->transaction_url ?? null;
            $payment_method = $request->payment_method ?? null;

            if ($cartItems->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            if ($payment_method === "CARD") {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                try {
                    $charge = Stripe\Charge::create([
                        "amount" => 100 * (int)$totalPrice,
                        "currency" => "usd",
                        "source" => $request->stripeToken,
                        "description" => "Payment success"
                    ]);

                    $payment_status = 'success';
                    $transaction_key = $charge->id;
                    $transaction_url = $charge->receipt_url;

                    Session::flash('success', 'Payment successful!');
                } catch (Stripe\Exception\CardException $e) {
                    $errorMessage = $e->getError()->message;
                    Session::flash('error', $errorMessage);
                    return back();
                } catch (Stripe\Exception\InvalidRequestException $e) {
                    $errorMessage = $e->getMessage();
                    Session::flash('error', $errorMessage);
                    return back();
                } catch (Stripe\Exception\AuthenticationException $e) {
                    $errorMessage = $e->getMessage();
                    Session::flash('error', $errorMessage);
                    return back();
                } catch (Stripe\Exception\ApiConnectionException $e) {
                    $errorMessage = $e->getMessage();
                    Session::flash('error', $errorMessage);
                    return back();
                } catch (Stripe\Exception\ApiErrorException $e) {
                    $errorMessage = $e->getMessage();
                    Session::flash('error', $errorMessage);
                    return back();
                }
            }

            $invID = uniqid() . uniqid();

            // Get the last order's order_no or start at 0001 if there are no orders yet
            $lastOrder = Order::orderBy('id', 'desc')->first();
            $lastOrderNo = $lastOrder ? (int) $lastOrder->order_no : 0;
            $newOrderNo = str_pad($lastOrderNo + 1, 4, '0', STR_PAD_LEFT); // Padding with leading zeros

            $data = [
                "email" => $email,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "phone_no" => $phone,
                "address" => $address,
                "city" => $city,
                "state" => $state,
                "zip" => $zip,
                "payment_method" => $payment_method,
                "status" => $status,
                "product_price" => $totalPrice,
                "basket_id" => $basket->id,
                "payment_status" => $status,
                "transaction_key" => $transaction_key,
                "transaction_url" => $transaction_url,
                "user_id" => auth()->user()->id,
                "inv_id" => $invID,
                "order_no" => $newOrderNo, // Set the new order number
            ];

            $order = Order::create($data);

            $basket->update(['status' => 0]);

            $req['booking'] = $data;

            Mail::send('email.thanks', $req,  function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Welcome to ' . config('app.name'));
            });

            return redirect()->route("thank-you", ["inv_id" => $invID]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
    }
}
