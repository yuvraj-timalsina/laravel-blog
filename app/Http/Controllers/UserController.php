<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }
    /**
     * Make User an admin.
     *
     * @return void
     */
    public function makeAdmin(User $user)
    {

        if ($user->isAdmin()) {
            $user->update(['role' => 'writer']);
            toastr()->error('User Demoted to Writer!');
        } else {
            $user->update(['role' => 'admin']);
            toastr()->success('User Assigned as Admin!');
        }
        return redirect(route('users.index'));
    }
}