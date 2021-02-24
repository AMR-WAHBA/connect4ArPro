<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Auth;
use Closure;
use Illuminate\Http\Request;

class RedirectAdminDependOnItsType
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $admin = auth('admin')->user();
            $type = $admin->type;
            if (($type == Admin::TYPE_ADMIN ||
                $type == Admin::TYPE_SUPER_ADMIN) &&
                \Request::is(['admin', 'admin/*'])) {
                return $next($request);
            }elseif (($type == Admin::TYPE_MANGER ||
                $type == Admin::TYPE_SUPER_MANGER) &&
                \Request::is(['manager', 'manager/*'])) {
                return $next($request);
            }
            return redirect($admin->getRouteName());
        }
        return redirect('login');
    }
}
