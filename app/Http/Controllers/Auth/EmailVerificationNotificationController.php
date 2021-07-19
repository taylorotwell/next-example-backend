<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return;
        }

        $request->user()->sendEmailVerificationNotification();

        return $request->wantsJson() ?
            response()->json(['status' => 'verification-link-sent']) :
            back()->with('status', 'verification-link-sent');
    }
}
