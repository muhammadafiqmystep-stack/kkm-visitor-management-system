<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        //query from table 'users' using model User
        $users = User::all();

        //return to views - resources/views/users/index.blade.php
        return view('users.index', compact('users'));
    }

    public function create()
    {
        // return to views - resources/views/users/create.blade.php
        return view('users.create');
    }

    public function store(Request $request)
    {
        //store data to table 'users' using model User Method POPO
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        //redirect to users.index
        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        // return to views - resources/views/users/show.blade.php
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // return to views - resources/views/users/edit.blade.php
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        //update data to table 'users' using Model User Method POPO
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();

        // redirect to users.index
        return redirect()->route('users.index');
    }

    public function delete(User $user)
    {
        //delete user
        $user->delete();

        return redirect()->route('users.index');
    }
}
