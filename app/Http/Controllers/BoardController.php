<?php

namespace App\Http\Controllers;
use App\Models\Board;
use App\Models\Boardgame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BoardController extends Controller {

    public function create($id) {
        if(Auth::check()) {
            $boardgame = Boardgame::findOrFail($id);

            return view('boards.create', compact('boardgame'));
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            $this->validateBoard($request);

            $board = new Board([
                'name' => $request->name,
                'description' => $request->description,
                'boardgame_id' => $request->boardgame_id,
                'valid' => false,
            ]);

            $board->save();

            return redirect()->route('boardgames.boards', ['id' => $request->boardgame_id]);
        } else {
            return redirect()->route('login');
        }
    }

    private function validateBoard(Request $request) {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
        ];

        $request->validate($rules);
    }
}