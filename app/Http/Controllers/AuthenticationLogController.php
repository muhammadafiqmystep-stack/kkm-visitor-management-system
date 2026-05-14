<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthenticationLogController extends Controller
{
    public function index(Request $request): View
    {
        $logs = $request->user()
            ->authentications()
            ->latest('login_at')
            ->paginate(15);

        return view('authentication_logs.index', compact('logs'));
    }
}
