<?php

namespace App\CustomHelpers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    /**
     * Check if user exists using email
     * @param $email
     * @return Boolean
     */
    public function checkIfUserExists($email)
    {
        if (User::where('email', $email)->count() > 0) {
            return true;
        }
        return false;
    }
}
