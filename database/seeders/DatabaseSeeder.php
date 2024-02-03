<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Board;
use App\Models\Boardgame;
use App\Models\Comment;
use App\Models\Game;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory()->count(5)->create();

        User::create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
            'phone' => '123456789',
            'country' => 'España',
            'city' => 'Alicante',
            'zip_code' => '12345',
            'photo' => 'images/admin.png',
            'admin' => true,
        ]);

        Boardgame::create([
            'name' => 'Monopoly',
            'description' => 'Juego de gestión relativamente sencillo.',
            'photo' => 'images/juego.png',
        ]);

        Board::create([
            'name' => 'España',
            'boardgame_id' => 1,
            'description' => 'Tablero del Monopoly inspirado en España.',
        ]);

        Game::create([
            'description' => "Partida para jugar al Monopoly",
            'boardgame_id' => 1,
            'closed' => false,
            'max_players' => 5,
            'players' => 0,
            'place' => 'Alicante',
        ]);

        Comment::create([
            'author' => 'Usuario de ejemplo',
            'game_id' => 1,
            'text' => 'Comentario de ejemplo',
            'user_id' => 1,
        ]);
    }
}
