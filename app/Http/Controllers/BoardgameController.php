<?php

namespace App\Http\Controllers;
use App\Models\Boardgame;
use App\Models\Board;
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
            $boardgames = DB::table('boardgames')->where('valid', '=', true)->get();

            return view('boardgames.index', compact('boardgames'));
        } else {
            return redirect()->route('login');
        }
    }

    public function show($id) {
        if(Auth::check()) {
            $boardgame = Boardgame::findOrFail($id);

            if($boardgame->valid) {
                return view('boardgames.show', compact('boardgame'));
            } else {
                return redirect()->route('boardgames.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function add($id) {
        if(Auth::check()) {
            $boardgame = Boardgame::findOrFail($id);

            if($boardgame->valid) {
                $user = auth()->user();

                $user->boardgames()->syncWithoutDetaching([$id]);
            }
            
            return redirect()->route('boardgames.index');
        } else {
            return redirect()->route('login');
        }
    }

    public function remove($id) {
        if(Auth::check()) {
            $boardgame = Board::findOrFail($id);

            if($boardgame->valid) {
                $user = auth()->user();

                $user->boardgames()->detach($id);
            }
    
            return redirect()->route('user.boardgames');
        } else {
            return redirect()->route('login');
        }
    }

    public function boards($id) {
        if(Auth::check()) {
            $boardgame = Boardgame::findOrFail($id);

            if($boardgame->valid) {
                $boards = DB::table('boards')->where('boardgame_id', '=', $id)->where('valid', '=', true)->get();

                return view('boardgames.boards', compact('boards', 'boardgame'));
            } else {
                return redirect()->route('boardgames.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            return view('boardgames.create');
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            $this->validateBoardgame($request);

            $boardgame = new Boardgame([
                'name' => $request->name,
                'description' => $request->description,
                'valid' => false,
            ]);

            $boardgame->save();

            $user = Auth::user();
            $user->boardgames()->syncWithoutDetaching([$boardgame->id]);

            return redirect()->route('user.boardgames');
        } else {
            return redirect()->route('login');
        }
    }

    private function validateBoardgame(Request $request) {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
        ];

        $request->validate($rules);
    }
}