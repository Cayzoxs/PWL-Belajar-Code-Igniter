<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function profile()
    {
        return view('v_profile');
    }
}