<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'boardgame_id',
        'description'
    ];

    public function boardgame() {
        return $this->belongsTo(Boardgame::class);
    }

    public function games() {
        return $this->belongsToMany(Game::class);
    }
}
