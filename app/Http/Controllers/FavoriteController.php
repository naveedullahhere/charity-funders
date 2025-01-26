<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }
    
        $request->validate([
            'funder_id' => 'required|exists:funders,id',
        ]);
    
        $user = Auth::user();
        $user->favorites()->attach($request->funder_id);
    
        return response()->json(['success' => true, 'message' => 'Added to favorites!']);
    }
    
    public function remove(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated'], 401);
        }
    
        $request->validate([
            'funder_id' => 'required|exists:funders,id',
        ]);
    
        $user = Auth::user();
        $user->favorites()->detach($request->funder_id);
    
        return response()->json(['success' => true, 'message' => 'Removed from favorites!']);
    }
}
