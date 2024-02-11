<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $validated = $validator->validated();

        $result = $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($result) {
            return back()->with('success', 'Password updated successfully');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
