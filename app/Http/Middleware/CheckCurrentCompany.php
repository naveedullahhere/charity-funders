<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCurrentCompany
{
    public function handle(Request $request, Closure $next, $permission = null)
    {
        $user = auth()->user();
        if (!$user->current_company_id) {
            return redirect('select-company');
        }

        $currentCompanyId = $user->current_company_id;
        if ($user->user_type === 'super-admin') {
            return $next($request);
        }
        $hasPermission = $user->companies()->where('company_id', $currentCompanyId)->wherePivot('permission', $permission)->exists();

        if (!$hasPermission) {
            abort(403, 'User does not have permission for this company.');
        }

        $request->merge(['current_company_id' => $currentCompanyId]);

        return $next($request);
    }
}
