<?php

namespace App\Http\Controllers\Admin;

use App\Repository\Eloquent\AdminLoginRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @var AdminLoginRepository $adminRepository
     */
    private $adminRepository;

    /**
     * LoginController constructor.
     * @param AdminLoginRepository $adminLoginRepository
     */
    public function __construct(AdminLoginRepository $adminLoginRepository)
    {
        $this->adminRepository = $adminLoginRepository;
    }

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
        if( $this->adminRepository->auth($request) )
            return redirect()->route('admin.dashboard');
        else
            return back()->withErrors([
                'error_message_1' => 'Логин или парол не правильно!'
            ]);
    }
}
