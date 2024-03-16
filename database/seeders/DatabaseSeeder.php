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
            'photo' => 'images/defaultUser.png',
            'admin' => true,
        ]);

        // Primer juego
        Boardgame::create([
            'name' => 'Monopoly',
            'description' => 'Juego de gestión relativamente sencillo.',
            'photo' => 'images/juego.png',
            'valid' => true,
        ]);

        Board::create([
            'name' => 'España',
            'boardgame_id' => 1,
            'description' => 'Tablero del Monopoly inspirado en España.',
            'valid' => true,
        ]);

        // Segundo juego
        Boardgame::create([
            'name' => 'Parchís',
            'description' => 'Juego con casillas y dados.',
            'photo' => 'images/juego2.png',
            'valid' => true,
        ]);

        Board::create([
            'name' => 'Clásico',
            'boardgame_id' => 2,
            'description' => 'Tablero del Parchís clásico.',
            'valid' => true,
        ]);

        // Tercer juego
        Boardgame::create([
            'name' => 'Cluedo',
            'description' => 'Juego para sentirte como un verdadero detective.',
            'photo' => 'images/juego3.png',
            'valid' => true,
        ]);

        Board::create([
            'name' => 'Mansión',
            'boardgame_id' => 3,
            'description' => 'Tablero del Cluedo inspirado en una mansión.',
            'valid' => true,
        ]);

        Board::create([
            'name' => 'Hotel',
            'boardgame_id' => 3,
            'description' => 'Tablero del Cluedo inspirado en un hotel.',
            'valid' => true,
        ]);

        // Cuarto juego
        Boardgame::create([
            'name' => 'Ajedrez',
            'description' => 'Juego de una sorprendente complejidad estratégica.',
            'photo' => 'images/juego4.png',
            'valid' => true,
        ]);

        Board::create([
            'name' => 'Clásico',
            'boardgame_id' => 4,
            'description' => 'Tablero del Ajedrez clásico.',
            'valid' => true,
        ]);

        Game::create([
            'description' => "Partida para jugar al Monopoly",
            'boardgame_id' => 1,
            'board_id' => 1,
            'user_id' => 6,
            'closed' => false,
            'max_players' => 5,
            'players' => 1,
            'place' => 'Alicante',
        ]);

        $game = Game::findOrFail(1);
        $game->users()->syncWithoutDetaching([6]);

        Comment::create([
            'author' => 'Usuario de ejemplo',
            'game_id' => 1,
            'text' => 'Comentario de ejemplo',
            'user_id' => 6,
        ]);
    }
}
