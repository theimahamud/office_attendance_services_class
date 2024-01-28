<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserStoreRequest $request, UserService $userService): RedirectResponse
    {
        $validated = $request->validated();

        $result = $userService->storeUser($validated);

        //        event(new Registered($result));
        //        Auth::login($result);

        if ($result) {
            Session::flash('success', 'User created successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'User not created successfully');

            return redirect()->back();
        }

    }
}
