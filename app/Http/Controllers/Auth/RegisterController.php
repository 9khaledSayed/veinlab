<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Employee;
use App\Hospital;
use App\Patient;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:employee');
        $this->middleware('guest:hospital');
        $this->middleware('guest:patient');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showEmployeeRegisterForm()
    {
        return view('auth.register', ['url' => 'employee']);
    }

    public function showHospitalRegisterForm()
    {
        return view('auth.register', ['url' => 'hospital']);
    }
    public function showPatientRegisterForm()
    {
        return view('auth.register', ['url' => 'patient']);
    }

    protected function createEmployee(Request $request)
    {
        $this->validator($request->all())->validate();
        $employee = Employee::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('/dashboard');
    }
    protected function createHospital(Request $request)
    {
        $this->validator($request->all())->validate();
        $hospital = Hospital::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('/dashboard');
    }
    protected function createPatient(Request $request)
    {
        $this->validator($request->all())->validate();
        $employee = Patient::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('/dashboard');
    }
}
