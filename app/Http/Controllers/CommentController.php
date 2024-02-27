<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller {

    public function store(Request $request, $gameId) {
        $this->validateComment($request);
        $user = auth()->user();

        $comment = new Comment([
            'author' => $user->name,
            'game_id' => $gameId,
            'user_id' => $user->id,
            'text' => $request->text,
        ]);

        $comment->save();

        return redirect()->route('games.show', ['id' => $gameId]);
    }

    public function delete($id, $gameId) {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->route('games.show', ['id' => $gameId]);
    }

    public function validateComment(Request $request) {
        $rules = [
            'text' => 'required|string|max:255',
        ];

        $request->validate($rules);
    }
}