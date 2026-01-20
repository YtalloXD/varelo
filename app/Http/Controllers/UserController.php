<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function store(Request $request)
{
    $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    $user->save();

    return redirect()->route('user.index')->with('success', 'User created successfully.');
}
}