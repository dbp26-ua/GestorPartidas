<?php

namespace App\Http\Controllers;
use App\Models\Boardgame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class BoardgameAdminController extends Controller {
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boardgames = Boardgame::all();
        
                return view('admin.boardgames.index', compact('boardgames'));
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function create() {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                return view('admin.boardgames.create');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateBoardgame($request);

                $boardgame = new Boardgame([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);

                $boardgame->save();

                return redirect()->route('admin.boardgames.index');       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function edit($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boardgame = Boardgame::findOrFail($id);

                return view('admin.boardgames.edit', compact('boardgame'));       
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, $id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $this->validateBoardgame($request);

                $boardgame = Boardgame::findOrFail($id);
                $boardgame->update($request->all());
                $boardgame->save();

                return redirect()->route('admin.boardgames.index');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id) {
        if(Auth::check()) {
            if(Auth::user()->admin) {
                $boardgame = Boardgame::findOrFail($id);
                $boardgame->delete();

                return redirect()->route('admin.boardgames.index');
            }
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