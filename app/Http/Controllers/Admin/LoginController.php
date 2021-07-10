<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function login()
    {
        if (Auth::check())
            redirect()->route('admin');
        else
            return view('admin.login');

    }

    public function auth(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'password' => 'required'
        ]);
        dd($request->post());
    }
}
