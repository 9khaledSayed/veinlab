<?php

namespace App\Http\Controllers\Dashboard;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Rules\EqualToCurrentPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function accountInfo()
    {
        $user = auth()->user();
        return view('dashboard.myProfile.account_info', compact('user'));
    }

    public function updateAccountInfo(Request $request)
    {
        $user = auth()->user();
        $user->update($request->validate([
            'fname_arabic' => 'required|string|max:191',
            'mname_arabic' => 'nullable|string|max:191',
            'lname_arabic' => 'required|string|max:191',
            'fname_english' => 'required|string|max:191',
            'mname_english' => 'nullable|string|max:191',
            'lname_english' => 'required|string|max:191',
            'email' => 'sometimes|required|email|unique:employees,email,' . $user->id,
        ]));
        return redirect(route('dashboard.myProfile.account_info'))->with('success', 'true');
    }

    public function changePasswordForm()
    {
        $user = auth()->user();
        return view('dashboard.myProfile.change_password', compact('user'));
    }
    public function changePassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'current_password' => ['required', 'string', new EqualToCurrentPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
        $user->update(['password' => Hash::make($request->password) ]);
        return redirect(route('dashboard.myProfile.change_password'))->with('success', 'true');
    }
}
