<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $invites = ProjectInvitation::where('email', '=', Auth::user()->email)->with(['inviter', 'project'])->get();
        
        return view('user.invites', compact('invites'));
    }
}
