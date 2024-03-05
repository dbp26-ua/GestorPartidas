<?php

namespace App\Http\Controllers;
use App\Models\Boardgame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardgameController extends Controller {

    public function index() {
        if(Auth::check()) {
            $boardgames = Boardgame::all();

            return view('boardgames.index', compact('boardgames'));
        } else {
            return redirect()->route('login');
        }
    }

    public function show($id) {
        if(Auth::check()) {
            $boardgame = Boardgame::findOrFail($id);

            return view('boardgames.show', compact('boardgame'));
        } else {
            return redirect()->route('login');
        }
    }

    public function add($id) {
        if(Auth::check()) {
            $user = auth()->user();

            $user->boardgames()->syncWithoutDetaching([$id]);

            return redirect()->route('boardgames.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function remove($id) {
        if(Auth::check()) {
            $user = auth()->user();

            $user->boardgames()->detach($id);
    
            return redirect()->route('user.boardgames');
        } else {
            return redirect()->route('login');
        }
    }
}