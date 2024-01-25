<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
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
    public function store(UserStoreRequest $request,UserService $userService): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($request->input('password'));
        $validated['birth_date'] = $request->input('birth_date');
        $validated['hire_date'] = $request->input('hire_date');
        $validated['uuid'] = Str::uuid();

        $result = $userService->storeUser($validated);

//        event(new Registered($result));

//        Auth::login($result);

        Session::flash('success','User created successfully');

        return redirect()->back();
    }
}
