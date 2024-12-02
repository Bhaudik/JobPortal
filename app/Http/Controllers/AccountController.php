<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function profile()
    {



        return view('front.Account.profile');
    }
}
