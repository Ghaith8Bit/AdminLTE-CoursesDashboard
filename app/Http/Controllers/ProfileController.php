<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Toastr;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile');
    }

    public function updateName(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->only(['name']), [
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.profile.index')->with('error', 'Please enter valid input.');
        }

        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('dashboard.profile.index')->with('success', 'Name updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'same:new_password'],
            'old_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('The old password is incorrect.');
                }
            }],
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard.profile.index')->with('error', 'Please enter valid input.');
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('dashboard.profile.index')->with('success', 'Password updated successfully.');
    }
}
