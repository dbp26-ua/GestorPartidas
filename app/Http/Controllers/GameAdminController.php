<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\User;
use App\Models\Boardgame;
use App\Models\Board;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class GameAdminController extends Controller {
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $games = Game::all();
        
                return view('admin.games.index', compact('games'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boardgames = Boardgame::all();
                $users = User::all();

                return view('admin.games.create', compact('boardgames', 'users'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateGame($request);

                $game = new Game([
                    'description' => $request->description,
                    'boardgame_id' => $request->boardgame_id,
                    'board_id' => 0,
                    'user_id' => $request->user_id,
                    'closed' => false,
                    'max_players' => $request->max_players,
                    'players' => 1,
                    'place' => $request->place,
                    'address' => $request->address,
                ]);

                $game->save();
                $game->users()->attach([$request->user_id]);
                $boardgame = $request->boardgame_id;

                $boards = DB::table('boards')->where('boardgame_id', '=', $boardgame)->get();

                return view('admin.games.createBoard', compact('boards', 'game'));       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function storeBoard(Request $request, $id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateGameBoard($request);

                $game = Game::findOrFail($id);
                $game->board_id = $request->board_id;
                $game->save();

                return redirect()->route('admin.games.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $game = Game::findOrFail($id);

                return view('admin.games.edit', compact('game'));       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateGameEdit($request);

                $game = Game::findOrFail($id);
                $game->update($request->all());
                $game->save();

                return redirect()->route('admin.games.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $game = Game::findOrFail($id);
                $game->delete();

                return redirect()->route('admin.games.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    private function validateGame(Request $request) {
        $rules = [
            'description' => 'required|string',
            'boardgame_id' => 'required|numeric',
            'user_id' => 'required|numeric',
            'max_players' => 'required|numeric',
            'place' => 'required|string',
            'address' => 'required|string',
        ];

        $request->validate($rules);
    }

    private function validateGameBoard(Request $request) {
        $rules = [
            'board_id' => 'required|numeric',
        ];

        $request->validate($rules);
    }

    private function validateGameEdit(Request $request) {
        $rules = [
            'description' => 'required|string',
            'closed' => 'required|boolean',
            'max_players' => 'required|numeric',
            'place' => 'required|string',
            'address' => 'required|string',
        ];

        $request->validate($rules);
    }
}