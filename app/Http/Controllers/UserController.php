<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function show() {
        if(Auth::check()) {
            $user = Auth::user();

            return view('users.profile', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }

    public function games() {
        if(Auth::check()) {
            $user = Auth::user();
            $games = $user->games();

            return view('users.games', compact('games'));
        } else {
            return redirect()->route('login');
        }
    }

    public function boardgames() {
        if(Auth::check()) {
            $user = Auth::user();
            $boardgames = $user->boardgames();

            return view('users.boardgames', compact('boardgames'));
        } else {
            return redirect()->route('login');
        }
    }
}