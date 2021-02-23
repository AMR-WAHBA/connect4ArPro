<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AtempetLoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout', 'routeInvalidProccess']);
    }

    public function viewLoginPage()
    {
        return view('backend.auth.login');
    }

    public function attemptLogin(AtempetLoginRequest $request)
    {
        try {
            $admin = Admin::where(function ($query) use ($request) {
                $query->where('name', $request->validated()['name']);
            })->first();
            dd($admin);
            $admin = DB::table('admins')->where('name', $request->validated()['name'])->first();

            if ($admin) {
                if (Hash::check($request->validated()['password'], $admin->password)) {
                    // login this admin
                    auth('admin')->login($admin, $request->validated()['remmber_me']);
                    return redirect()->route('admin.index');
                } else {
                    $this->passwordError = true;
                }
            } else {
                $this->identifyError = true;
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function logout(Request $request)
    {
        auth('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $response = $this->loggedOut($request);
        if ($response) {
            return $response;
        }

        return $request->wantsJson()
        ? new Response('', 204)
        : redirect('login');
    }
    protected function loggedOut(Request $request)
    {
        //
    }
    // TODO : دى عشان لو اليوزر كتب راوت غلط لو هو مسجل دخول حوله لصفحة ولو هو مش مسجل رجعه لصفحة الدخول
    public function routeInvalidProccess()
    {
        if (auth('admin')->check()) {
            return abort(404);
        }
        return redirect()->route('admin.login');
    }
}
