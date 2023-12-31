<?php

namespace App\Containers\Authentication\UI\WEB\Controllers;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\Authentication\UI\WEB\Requests\LoginRequest;
use App\Containers\Authentication\UI\WEB\Requests\LogoutRequest;
use App\Containers\Authentication\UI\WEB\Requests\ViewDashboardRequest;
use App\Containers\User\UI\API\Requests\ForgotPasswordRequest;
use App\Containers\User\UI\API\Requests\ResetPasswordRequest;
use App\Ship\Parents\Controllers\WebController;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Support\Facades\Auth;
use Exception;

/**
 * Class Controller
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class Controller extends WebController
{

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPage()
    {
        return view('authentication::login');
    }

    /**
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginPageFox()
    {
        return Auth::check() ? redirect('/') : view('authentication::login-page');
    }


    /**
    * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
    public function logoutNormie(LogoutRequest $request)
    {
        Apiato::call('Authentication@WebLogoutAction');

        return redirect('')->with('status', 'User logged out!');
    }

    /**
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logoutAdmin(LogoutRequest $request)
    {
        Apiato::call('Authentication@WebLogoutAction');

        return redirect('login');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginFox(LoginRequest $request)
    {   
        try {
            $result = Apiato::call('Authentication@WebLoginAction', [new DataTransporter($request)]);
        } catch (Exception $e) {
            return redirect('login')->with('status', $e->getMessage());
        }

                                //Failed???                             //Success
        return is_array($result) ? redirect()->back()->with($result) : redirect('')->with('status', 'Login successfully');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\LoginRequest $request
     *
     * @return  \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginAdmin(LoginRequest $request)
    {
        try {
            $result = Apiato::call('Authentication@WebAdminLoginAction', [new DataTransporter($request)]);
        } catch (Exception $e) {
            return redirect('login')->with('status', $e->getMessage());
        }

        return is_array($result) ? redirect('login')->with($result) : redirect('dashboard');
    }

    /**
     * @param \App\Containers\Authentication\UI\WEB\Requests\ViewDashboardRequest $request
     *
     * @return  \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewDashboardPage(ViewDashboardRequest $request)
    {
        return view('authentication::dashboard');
    }
}
