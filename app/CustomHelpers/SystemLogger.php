<?php

namespace App\CustomHelpers;

use App\Systemlogs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemLogger
{
    /**
     * adds log event
     * @param $message
     * @param $username = null
     * @return Boolean
     */
    public function addLog($message, $username = null)
    {

        $log = new   Systemlogs();
        $log->message = $message;

        if ($username != null) {

            $log->user = $username;
        }
        $log->save();
        return true;
    }
}
