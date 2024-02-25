<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'boardgame_id',
        'board_id',
        'user_id',
        'closed',
        'max_players',
        'players',
        'place'
    ];

    public function boardgame() {
        return $this->belongsTo(Boardgame::class);
    }

    public function board() {
        return $this->belongsTo(Board::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
