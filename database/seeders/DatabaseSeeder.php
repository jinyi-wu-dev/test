<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'      => 'test_user',
            'email'     => 'test@example.com',
            'password'  => Hash::make('password'),
        ]);
        User::factory()->count(100)->create();

        DB::table('admins')->insert([
            'name'      => 'admin',
            //'email'     => 'admin@example.com',
            'password'  => Hash::make('password'),
        ]);

        for ($i=1; $i<=10; $i++) {
            DB::table('icons')->insert([
                'title' => 'icon'.$i,
            ]);
        }

        for ($i=1; $i<=10; $i++) {
            DB::table('features')->insert([
                'line' => fake()->randomElement(['vertical', 'horizontal']),
                'title' => '特徴'.$i,
            ]);
            DB::table('feature_details')->insert([
                'feature_id' => $i,
                'language' => 'jp',
                'title' => '特徴'.$i,
                'body' => fake()->realText(10),
            ]);
            DB::table('feature_details')->insert([
                'feature_id' => $i,
                'language' => 'en',
                'title' => 'feature'.$i,
                'body' => fake()->paragraph(1),
            ]);
        }

        for ($i=1; $i<=10; $i++) {
            DB::table('series')->insert([
                'category' => 'lighting',
                'genre' => fake()->randomElement(['lt_line', 'lt_ring', 'lt_transmission', 'lt_flatsurface', 'lt_dome', 'lt_coaxial-spot', 'lt_other']),
                'model' => 'LT_TYPE'.$i,
                'is_new' => fake()->randomElement([0, 1]),
                'is_end' => fake()->randomElement([0, 1]),
                'is_publish' => fake()->randomElement([0, 1]),
                'memo' => fake()->realText(20),
            ]);
            $id = DB::getPdo()->lastInsertId();
            DB::table('series_details')->insert([
                'series_id' => $id,
                'language' => 'jp',
                'name' => '照明'.$i,
                'model' => 'LT_TYPE'.$i,
                'body1' => fake()->realText(20),
                'body2' => fake()->realText(20),
                'body3' => fake()->realText(20),
                'note' => fake()->realText(20),
            ]);
            DB::table('series_details')->insert([
                'series_id' => $id,
                'language' => 'en',
                'name' => 'lighting'.$i,
                'body1' => fake()->paragraph(1),
                'body2' => fake()->paragraph(1),
                'body3' => fake()->paragraph(1),
                'note' => fake()->paragraph(1),
            ]);
        }
    }
}
