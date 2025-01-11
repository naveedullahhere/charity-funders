<?php

use App\Models\Company;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getCurrentCompany')) {
    /**
     * Get the current company of the authenticated user.
     *
     * @return Company|null
     */
    function getCurrentCompany()
    {
        $user = Auth::user(); // Get the authenticated user
        if (!$user || !$user->current_company_id) {
            return null; // Return null if no user or no company assigned
        }

        return Company::find($user->current_company_id); // Return the company instance
    }
}

if (!function_exists('image_path')) {
    function image_path($path)
    {
        // Path to the placeholder image
        $placeholder = asset('management/placeholder.png');
        
        // Check if the given path is null or the file doesn't exist
        if (empty($path) || !File::exists(public_path($path))) {
            return $placeholder;
        }

        // Return the asset path if the file exists
        return asset($path);
    }
}
