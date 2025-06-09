<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard'); // arahkan ke resources/views/user/dashboard.blade.php
    }
}

