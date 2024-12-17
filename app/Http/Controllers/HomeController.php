<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Order;
use App\Models\Page;
use App\Models\States;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => ['index']]);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $orders = Order::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('id', 'like', $searchTerm);
                $sq->orWhere('email', 'like', $searchTerm);
                $sq->orWhere('lead_first_name', 'like', $searchTerm);
                $sq->orWhere('lead_last_name', 'like', $searchTerm);
            });
        })->latest()->paginate(5);

        return view('management.dashboard.index', compact('orders'));
    }

    public function getCitiesByState(Request $request)
    {
        $countryId = $request->input('state_id');
        $cities = Cities::where('state_id', $countryId)->get();
        return response()->json($cities);
    }

    public function getStatesByCountry(Request $request)
    {
        $countryId = $request->input('country_id');
        $cities = States::where('country_id', $countryId)->get();
        return response()->json($cities);
    }
}
