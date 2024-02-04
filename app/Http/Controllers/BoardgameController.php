<?php

namespace App\Http\Controllers;
use App\Models\Boardgame;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class BoardgameController extends Controller {

    public function index() {
        $boardgames = Boardgame::all();

        return view('boardgames.index', compact('boardgames'));
    }

    public function show($id) {
        $boardgame = Boardgame::findOrFail($id);

        return view('boardgames.show', compact('boardgame'));
    }
}