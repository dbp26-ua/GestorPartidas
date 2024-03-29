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
        $boardgames = DB::table('boardgames')->where('valid', '=', true)->get();
        $boardgame_id = -1;
        $creator = "";
        $closed = -1;
        $address = "";

        return view('games.index', compact('games', 'boardgames', 'boardgame_id', 'creator', 'closed', 'address'));
    }

    public function show($id) {
        $game = Game::findOrFail($id);
        $comments = DB::table('comments')->where('game_id', '=', $id)->get();

        return view('games.show', compact('game', 'comments'));
    }

    public function create() {
        if(Auth::check()) {
            $boardgames = Auth::user()->boardgames;

            return view('games.create', compact('boardgames'));
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            $this->validateGame($request);
            $user = auth()->user();

            $game = new Game([
                'description' => $request->description,
                'boardgame_id' => $request->boardgame_id,
                'board_id' => 1,
                'user_id' => $user->id,
                'closed' => false,
                'max_players' => $request->max_players,
                'players' => 1,
                'place' => $request->place,
                'address' => $request->address,
            ]);

            $game->save();
            $game->users()->attach([$user->id]);
            $boardgame = $request->boardgame_id;

            $boards = DB::table('boards')->where('boardgame_id', '=', $boardgame)->where('valid', '=', true)->get();

            return view('games.createBoard', compact('boards', 'game'));
        } else {
            return redirect()->route('login');
        }
    }

    public function storeBoard(Request $request) {
        if(Auth::check()) {
            $game = Game::findOrFail($request->game_id);
            $this->validateGameBoard($request);

            $game->board_id = $request->board_id;
            $game->save();

            return redirect()->route('games.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            if(Auth::user()->id == $game->creator->id) {
                return view('games.edit', compact('game'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            if(Auth::user()->id == $game->creator->id) {
                $this->validateGameUpdate($request);

                try {
                    $game->update($request->all());
                    $game->save();

                    return redirect()->route('games.show', ['id' => $id]);
                } catch(Exception $exception) {
                    return redirect()->route('games.show', ['id' => $id]);
                }
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function remove($gameId, $userId) {
        if(Auth::check()) {
            $game = Game::findOrFail($gameId);
            $game->users()->detach($userId);

            $game->players = $game->players - 1;
            $game->save();

            return redirect()->route('games.show', ['id' => $id]);
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            if(Auth::user()->id == $game->creator->id) {
                $game->delete();

                return redirect()->route('games.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function filter(Request $request) {
        $games = Game::all();
        $boardgames = Boardgame::all();

        if($request->boardgame_id != -1) {
            $games = $games->filter(function ($game) use ($request) {
                if($request->boardgame_id == $game->boardgame->id) {
                    return true;
                }
    
                return false;
            })->values();
        }

        if($request->creator != null && $request->creator != "") {
            $games = $games->filter(function ($game) use ($request) {
                if($request->creator == $game->creator->name) {
                    return true;
                }
    
                return false;
            })->values();
        }

        if($request->closed != -1) {
            $games = $games->filter(function ($game) use ($request) {
                if($request->closed == $game->closed) {
                    return true;
                }
    
                return false;
            })->values();
        }

        if($request->address != null && $request->address != "") {
            $games = $games->filter(function ($game) use ($request) {
                if(str_contains($game->address, $request->address) || str_contains($game->city, $request->address)) {
                    return true;
                }
    
                return false;
            })->values();
        }

        $boardgame_id = $request->boardgame_id;
        $creator = $request->creator;
        $closed = $request->closed;
        $address = $request->address;

        return view('games.index', compact('games', 'boardgames', 'boardgame_id', 'creator', 'closed', 'address'));
    }

    public function transferForm($id) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            $user = Auth::user();
            $users = $game->users;

            if($user->id == $game->creator->id) {
                return view('games.transfer', compact('users', 'game'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function transfer($id, $userId) {
        if(Auth::check()) {
            $game = Game::findOrFail($id);
            $user = Auth::user();

            if($user->id == $game->creator->id) {
                $game->user_id = $userId;
                $game->save();

                return redirect()->route('games.show', ['id' => $id]);
            }
        } else {
            return redirect()->route('login');
        }
    }

    private function validateGameUpdate(Request $request) {
        $rules = [
            'description' => 'required|string|max:255',
            'max_players' => 'required|numeric',
            'place' => 'required|string|max:100',
            'address' => 'required|string|max:255',
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
            'address' => 'required|string|max:255',
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