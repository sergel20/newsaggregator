<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
public function register(Request $request)
{
    $fields=$request->validate([
        'name' => ['required', 'regex:/^[A-Z\s]+$/'], // All uppercase letters
        'email' => 'required|email',
        'number' => 'required|numeric',
        'password' => 'required|min:6',
    ]);
    $user=User::create($fields);
    auth()->login($user);

    return redirect("/home");
}

    }
