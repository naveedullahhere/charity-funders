<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionConfirmationMail;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'organisationName' => 'required|string|max:255',
            'charityNo' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'townOrcity' => 'required|string|max:255',
            'postCode' => 'required|string|max:255',
            'emailAddress' => 'required|email|max:255',
            'confirmEmail' => 'required|email|same:emailAddress',
            'telephoneNumber' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
            // 'confirmPassword' => 'required|string|min:8|same:password',
            'newsletter' => 'nullable|in:0,1',
            'terms' => 'required|accepted',
            'subscriptionType' => 'required|in:org,ind',
            'subscriptionAmount' => 'required|numeric',
            'paymentMethod' => 'required|in:card,invoice',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $subscription = new Subscription();
        $subscription->fill($request->all());
        $subscription->save();

        Mail::to(env('SUB_MAIL'))->send(new SubscriptionConfirmationMail($subscription->toArray()));

        return response()->json([
            'success' => true,
            'message' => 'Subscription created successfully!'
        ]);
    }
}
