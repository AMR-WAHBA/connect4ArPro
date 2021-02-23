<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AtempetLoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
            $validatedData = $request->validated();
            $admin = Admin::where('name', $validatedData['name'])->first([
                'id','name','password'
            ]);
            if ($admin) {
                if (Hash::check($validatedData['password'], $admin->password)) {
                    auth('admin')->login($admin, $validatedData['remmber_me']);
                    return redirect()->route('admin.index');
                } else {
                    $errors['password'] = trans('auth.password');
                    $this->passwordError = true;
                }
            } else {
                $errors['name'] = trans('auth.failed');
            }

            return back()->withErrors($errors)->withInput();

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
