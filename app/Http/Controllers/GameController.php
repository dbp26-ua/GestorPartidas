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
        $comments = DB::table('comments')->where('game_id', '=', $id)->get();

        return view('games.show', compact('game', 'comments'));
    }

    public function create() {
        $boardgames = Auth::user()->boardgames;

        return view('games.create', compact('boardgames'));
    }

    public function store(Request $request) {
        $this->validateGame($request);
        $user = auth()->user();

        $game = new Game([
            'description' => $request->description,
            'boardgame_id' => $request->boardgame_id,
            'board_id' => 0,
            'user_id' => $user->id,
            'closed' => false,
            'max_players' => $request->max_players,
            'players' => 1,
            'place' => $request->place,
        ]);

        $game->save();
        $game->users()->attach([$user->id]);
        $boardgame = $request->boardgame_id;

        $boards = DB::table('boards')->where('boardgame_id', '=', $boardgame)->get();

        return view('games.createBoard', compact('boards', 'game'));
    }

    public function storeBoard(Request $request) {
        $this->validateGameBoard($request);

        $game = Game::findOrFail($request->game_id);
        $game->board_id = $request->board_id;
        $game->save();

        return redirect()->route('games.index');
    }

    public function edit($id) {
        $game = Game::findOrFail($id);
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, $id) {
        $this->validateGameUpdate($request);

        try {
            $game = Game::findOrFail($id);
            $game->update($request->all());
            $game->save();

            return redirect()->route('games.show', ['id' => $id]);
        } catch(Exception $exception) {
            return redirect()->route('games.show', ['id' => $id]);
        }
    }

    public function remove($gameId, $userId) {
        $game = Game::findOrFail($gameId);
        $game->users()->detach($userId);

        $game->players = $game->players - 1;
        $game->save();

        return redirect()->route('games.show', ['id' => $id]);
    }

    public function delete($id) {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index');
    }

    private function validateGameUpdate(Request $request) {
        $rules = [
            'description' => 'required|string|max:255',
            'max_players' => 'required|numeric',
            'place' => 'required|string|max:100',
            'closed' => 'required|numeric',
        ];

        $request->validate($rules);
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

    private function validateGameBoard(Request $request) {
        $rules = [
            'board_id' => 'required|numeric',
        ];

        $request->validate($rules);
    }
}