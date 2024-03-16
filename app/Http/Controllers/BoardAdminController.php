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

class BoardAdminController extends Controller {
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boards = Board::all();
        
                return view('admin.boards.index', compact('boards'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boardgames = Boardgame::all();

                return view('admin.boards.create', compact('boardgames'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateBoard($request);

                $board = new Board([
                    'name' => $request->name,
                    'description' => $request->description,
                    'boardgame_id' => $request->boardgame_id,
                    'valid' => true,
                ]);

                $board->save();

                return redirect()->route('admin.boards.index');       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $board = Board::findOrFail($id);

                return view('admin.boards.edit', compact('board'));       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateBoardEdit($request);

                $board = Board::findOrFail($id);
                $board->update($request->all());
                $board->save();

                return redirect()->route('admin.boards.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $board = Board::findOrFail($id);
                $board->delete();

                return redirect()->route('admin.boards.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function makeValid($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $board = Board::findOrFail($id);
                $board->valid = true;
                $board->save();

                return redirect()->route('admin.boards.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    private function validateBoard(Request $request) {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
            'boardgame_id' => 'required|numeric',
        ];

        $request->validate($rules);
    }

    private function validateBoardEdit(Request $request) {
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
        ];

        $request->validate($rules);
    }
}