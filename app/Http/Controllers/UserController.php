<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * ADMIN VIEW USERS
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }
}