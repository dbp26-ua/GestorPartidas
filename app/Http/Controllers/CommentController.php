<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller {

    public function store(Request $request, $gameId) {
        if(Auth::check()) {
            $user = auth()->user();
            $game = Game::findOrFail($gameId);
            if(in_array($user, $game->users)) {
                $this->validateComment($request);

                $comment = new Comment([
                    'author' => $user->name,
                    'game_id' => $gameId,
                    'user_id' => $user->id,
                    'text' => $request->text,
                ]);

                $comment->save();

                return redirect()->route('games.show', ['id' => $gameId]);
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function delete($id, $gameId) {
        if(Auth::check()) {
            $comment = Comment::findOrFail($id);
            $game = Game::findOrFail($gameId);
            if($comment->user_id == Auth::user()->id || $game->creator->id == Auth::user()->id) {
                $comment->delete();

                return redirect()->route('games.show', ['id' => $gameId]);
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function validateComment(Request $request) {
        $rules = [
            'text' => 'required|string|max:255',
        ];

        $request->validate($rules);
    }
}