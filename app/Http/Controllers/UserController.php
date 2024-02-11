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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', User::class);
        $departments = Department::orderBy('title')->get();
        $designations = Designation::orderBy('title')->get();
        $users = User::with(['department', 'designation'])->orderBy('created_at', 'DESC')->get();

        return view('users.index', compact('users','designations','departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('view', User::class);
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

        $this->authorize('create', User::class);
        $validated = $request->validated();

        $result = $userService->storeUser($validated, $request->hasFile('image') ? $request->file('image') : null);

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
    public function show(User $user)
    {
        $this->authorize('view', $user);
        $user->load('department', 'designation');

        return view('users.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        $this->authorize('viewAny', $user);
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
        $this->authorize('update', [$user, Auth::user()]);
        $validated = $request->validated();

        $result = $userService->updateUser($validated, $user, $request->hasFile('image') ? $request->file('image') : null);

        if ($result) {
            Session::flash('success', 'User updated successfully');

            return redirect()->back();
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
        $this->authorize('delete', $user);
        $userService->destroyUser($user);

        return response('User deleted');
    }
}
