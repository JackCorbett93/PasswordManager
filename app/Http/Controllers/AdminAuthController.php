<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    protected $guard = 'admin';

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
}
