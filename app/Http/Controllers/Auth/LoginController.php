<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers {

        logout as performLogout;

    }

    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:employee')->except('logout');
        $this->middleware('guest:hospital')->except('logout');
        $this->middleware('guest:patient')->except('logout');
    }

    /*begin::Employee Login*/
    public function showEmployeeLoginForm()
    {
        return view('auth.login', ['url' => 'employee']);
    }

    public function employeeLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|exists:employees',
            'password' => 'required|min:6|'
        ]);
        $employee = Employee::withoutGlobalScopes()->whereEmail($request->email)->first();
        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            setting(['current_branch' => $employee->branch_id == '1' ? 'all' : $employee->branch_id])->save();
            return redirect()->intended('/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'password' => __('Incorrect Password.'),
        ]);
    }
    /*end::Employee Login*/

    /*begin::Hospital Login*/
    public function showHospitalLoginForm()
    {
        return view('auth.login', ['url' => 'hospital']);
    }

    public function hospitalLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|exists:hospitals',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('hospital')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'password' => __('Incorrect Password.'),
        ]);
    }
    /*end::Hospital Login*/

    /*begin::Patient Login*/
    public function showPatientLoginForm()
    {
        return view('auth.login', ['url' => 'patient']);
    }

    public function patientLogin(Request $request)
    {
        $this->validate($request, [
            'id_no'   => 'required|min:8|exists:patients',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('patient')->attempt(['id_no' => $request->id_no, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/dashboard');
        }
        return back()->withInput($request->only('id_no', 'remember'))->withErrors([
            'password' => __('Incorrect Password.'),
        ]);
    }
    /*end::Patient Login*/



    public function logout(Request $request)
    {
        if (auth()->guard('employee')->check()){
            $this->performLogout($request);
            return redirect('/login/employee');
        }else{
            $this->performLogout($request);
            return redirect('/');
        }
    }

}
