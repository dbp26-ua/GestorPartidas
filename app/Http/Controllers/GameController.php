<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Boardgame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class GameController extends Controller {
    
    public function index() {
        $games = Game::all();

        return view('games.index', compact('games'));
    }

    public function show($id) {
        $game = Game::findOrFail($id);

        return view('games.show', compact('game'));
    }

    public function create() {
        $boardgames = Boardgame::all();

        return view('games.create', compact('boardgames'));
    }

    public function store(Request $request) {
        $this->validateGame($request);
        $user = auth()->user();

        $game = new Game([
            'description' => $request->description,
            'boardgame_id' => $request->boardgame_id,
            'user_id' => $user->id,
            'closed' => false,
            'max_players' => $request->max_players,
            'players' => 1,
            'place' => $request->place,
        ]);

        $game->save();
        $game->users()->attach([$user->id]);      

        return redirect()->route('games.index');
    }

    private function validateGame(Request $request) {
        $rules = [
            'description' => 'nullable|string|max:255',
            'boardgame_id' => 'required|numeric',
            'max_players' => 'required|numeric',
            'place' => 'required|string|max:100',
        ];

        $request->validate($rules);
    }
}