<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('frontend.order.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {



        $bask = Basket::where('uniq_id',$request->basketId)->first();

        $email = $request->email ?? null;
        $lead_title = $request->lead_title ?? null;
        $lead_first_name = $request->lead_first_name ?? null;
        $lead_last_name = $request->lead_last_name ?? null;
        $lead_phone = $request->lead_phone ?? null;
        $vehicle_registration = $request->vehicle_registration ?? null;
        $vehicle_model = $request->vehicle_model ?? null;
        $vehicle_color = $request->vehicle_color ?? null;
        $passenger = $request->passenger ?? null;
        $terminal_out = $request->terminal_out ?? null;
        $terminal_in = $request->terminal_in ?? null;
        $flight_out = $request->flight_out ?? null;
        $flight_in = $request->flight_in ?? null;
        $product_price = $request->product_price ?? null;
        $basket_id = $request->basketId;
        $product_price = $request->product_price ?? null;
        $payment_method = $request->payment_method ?? null;
        $payment_status = $request->payment_status ?? null;
        $transaction_key = $request->transaction_key ?? null;
        $transaction_url = $request->transaction_url ?? null;
        $product_id = $request->product_id ?? null;
        $product_name = $request->product_name ?? null;
        $user_id = $request->user_id ?? null;

        $email = $request->email ?? null;
        if (Auth::guest()) {
            $user = User::where('email', $email)->first();
        }else{
            $user = User::where('email', auth()->user()->email)->first();
        }
        
        if ($user) {
            $user_id = $user->id;
        } else {
            $uid =  uniqid();
            $user = new User();
            $user->name = explode("@", $email)[0];
            $user->email = $email;
            $user->password =Hash::make($uid);
            $user->save();
            $user_id = $user->id;
            $user['password'] = $uid;
            $data['user'] = $user;
        }

        if ($payment_method === "CARD") {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $charge = Stripe\Charge::create([
                    "amount" => 100 * (int)$product_price,
                    "currency" => "usd",
                    "source" => $request->stripeToken,
                    "description" => "Payment for product: $product_name"
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

        $data = [
            "email" => $email,
            "lead_title" => $lead_title,
            "lead_first_name" => $lead_first_name,
            "lead_last_name" => $lead_last_name,
            "lead_phone" => $lead_phone,
            "vehicle_registration" => $vehicle_registration,
            "vehicle_model" => $vehicle_model,
            "vehicle_color" => $vehicle_color,
            "passenger" => $passenger,
            "terminal_out" => $terminal_out,
            "terminal_in" => $terminal_in,
            "flight_out" => $flight_out,
            "flight_in" => $flight_in,
            "product_price" => $product_price,
            "basket_id" => $basket_id,
            "payment_method" => $payment_method,
            "payment_status" => $payment_status,
            "transaction_key" => $transaction_key,
            "transaction_url" => $transaction_url,
            "user_id" => $user_id,
            "inv_id" => $invID
        ];

       $order = Order::create($data);

        $bask->update(['status'=>1]);


        $req['booking'] = $data;

        Mail::send('email.thanks',$req ,  function ($message) use ($request,$user) {
            $message->to($request->email)
                ->subject('Welcome to '.config('app.name'));
        });
//        return redirect()->route("thanks", ["inv_id" => $invID]);
        return redirect()->route("thank-you", ["inv_id" => $invID]);
        // return route("frontend.order.thanks", ["inv_id" => $invID]);
    }
}
