<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Country;
use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['department', 'designation'])->orderBy('created_at', 'DESC')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::orderBy('title')->get();
        $designations = Designation::orderBy('title')->get();
        $countries = Country::orderBy('name')->get();

        return view('users.create', compact('departments', 'designations', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request, UserService $userService): RedirectResponse
    {
        $validated = $request->validated();

        $result = $userService->storeUser($validated);

        if ($result) {
            Session::flash('success', 'User created successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'User not created successfully');

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $departments = Department::orderBy('title')->get();
        $designations = Designation::orderBy('title')->get();
        $countries = Country::orderBy('name')->get();

        return view('users.edit', compact('user', 'departments', 'designations', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user, UserService $userService)
    {
        $validated = $request->validated();

        $result = $userService->updateUser($validated, $user);

        if ($result) {
            Session::flash('success', 'User updated successfully');

            return redirect()->route('users.index');
        } else {
            Session::flash('error', 'User not updated successfully');

            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserService $userService)
    {
        $userService->destroyUser($user);

        return response('User deleted');
    }
}
