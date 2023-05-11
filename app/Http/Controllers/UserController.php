<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateProfileRequest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->except(auth()->id());
        return view('user.index', compact('users'));
    }


    public function edit()
    {
        return view('user.edit', ['user' => auth()->user()]);
    }


    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->validated());
        toastr()->success('Profile Updated Successfully!');
        return back();
    }

    public function makeAdmin(User $user)
    {

        if ($user->isAdmin()) {
            $user->update(['role' => 'writer']);
            toastr()->error('User Demoted to Writer!');
        } else {
            $user->update(['role' => 'admin']);
            toastr()->success('User Assigned as Admin!');
        }
        return to_route('users.index');
    }
}