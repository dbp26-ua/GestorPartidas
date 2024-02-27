<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Game;
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
            $games = $user->games;

            return view('users.games', compact('games'));
        } else {
            return redirect()->route('login');
        }
    }

    public function boardgames() {
        if(Auth::check()) {
            $user = Auth::user();
            $boardgames = $user->boardgames;

            return view('users.boardgames', compact('boardgames'));
        } else {
            return redirect()->route('login');
        }
    }

    public function add($id) {
        if(Auth::check()) {
            $user = Auth::user();
            $user->games()->syncWithoutDetaching([$id]);

            $game = Game::findOrFail($id);
            $game->players = $game->player + 1;

            if($game->players >= $game->max_players) {
                $game->closed = true;
            }

            return redirect()->route('games.show', ['id' => $id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function remove($id) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            if(Auth::user()->id == $game->creator->id) {
                 $game->delete();

                 return redirect()->route('games.index');
            } else {
                $user = Auth::user();
                $user->games()->detach($id);

                $game->players = $game->player - 1;

                if($game->players < $game->max_players) {
                    $game->closed = false;
                }
                
                return redirect()->route('games.show', ['id' => $id]);
            }
        } else {
            return redirect()->route('login');
        }
    }
}