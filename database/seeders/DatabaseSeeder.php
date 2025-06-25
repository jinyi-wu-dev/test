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
            'name1'      => 'test_user',
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

        for ($i=1; $i<=20; $i++) {
            DB::table('features')->insert([
                'layout' => fake()->randomElement(['vertical', 'horizontal']),
                'title' => '特徴'.$i,
            ]);
            DB::table('feature_details')->insert([
                'feature_id' => $i,
                'language' => 'ja',
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
        
        $count = 1;
        for ($i=1; $i<=40; $i++) {
            $pos = (int)(($i-1)/10);
            DB::table('series')->insert([
                'category' => match($pos) {
                    0 => 'lighting',
                    1 => 'controller',
                    2 => 'cable',
                    3 => 'option',
                },
                'genre' => match($pos) {
                    0 => fake()->randomElement(['lt_line', 'lt_ring', 'lt_transmission', 'lt_flatsurface', 'lt_dome', 'lt_coaxial-spot', 'lt_other']),
                    1 => fake()->randomElement(['cr_pwm', 'cr_v_current', 'cr_v_voltage', 'cr_overdrive']),
                    2 => fake()->randomElement(['cb_lighting', 'cb_external']),
                    3 => fake()->randomElement(['op_lighting', 'op_other']),
                },
                'model' => match($pos) {
                    0 => 'LT_TYPE'.$i%10,
                    1 => 'CR_TYPE'.$i%10,
                    2 => 'CB_TYPE'.$i%10,
                    3 => 'OP_TYPE'.$i%10,
                },
                'is_new' => fake()->randomElement([0, 1]),
                'is_end' => fake()->randomElement([0, 1]),
                'is_publish' => fake()->randomElement([0, 1]),
                'memo' => fake()->realText(20),
            ]);
            $series_id = DB::getPdo()->lastInsertId();
            DB::table('series_details')->insert([
                'series_id' => $series_id,
                'language' => 'ja',
                'name' => match($pos) {
                    0 => '照明'.$i%10,
                    1 => 'コントローラ'.$i%10,
                    2 => 'ケーブル'.$i%10,
                    3 => 'オプション'.$i%10,
                },
                'model' => match($pos) {
                    0 => 'LT_TYPE'.$i%10,
                    1 => 'CR_TYPE'.$i%10,
                    2 => 'CB_TYPE'.$i%10,
                    3 => 'OP_TYPE'.$i%10,
                },
                'body1' => fake()->realText(20),
                'body2' => fake()->realText(20),
                'body3' => fake()->realText(20),
                'note' => fake()->realText(20),
            ]);
            DB::table('series_details')->insert([
                'series_id' => $series_id,
                'language' => 'en',
                'name' => match($pos) {
                    0 => 'lighting'.$i%10,
                    1 => 'controller'.$i%10,
                    2 => 'cable'.$i%10,
                    3 => 'option'.$i%10,
                },
                'body1' => fake()->paragraph(1),
                'body2' => fake()->paragraph(1),
                'body3' => fake()->paragraph(1),
                'note' => fake()->paragraph(1),
            ]);
            
            $cable_group = [];
            for ($j=1; $j<=5; $j++) {
                DB::table('items')->insert([
                    'series_id' => $series_id,
                    'is_new' => fake()->randomElement([0, 1]),
                    'is_end' => fake()->randomElement([0, 1]),
                    'is_publish' => fake()->randomElement([0, 1]),
                    'is_lend' => fake()->randomElement([0, 1]),
                    'model' => 'MODEL_'.$count++,
                    'product_number' => uniqid(),
                    'operating_temperature' => fake()->randomNumber(),
                    'operating_humidity' => fake()->randomNumber(),
                    'weight' => fake()->randomNumber(),
                    'memo' => fake()->realText(20),
                ]);
                $item_id = DB::getPdo()->lastInsertId();
                if ($pos==0) {
                    DB::table('lighting_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'ja',
                        'type' => fake()->word(),
                        'color1' => fake()->word(),
                        'color2' => fake()->word(),
                        'color3' => fake()->word(),
                        'power_consumption' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'input' => fake()->randomNumber(),
                        'etc' => fake()->word(),
                        'description1' => fake()->realText(20),
                        'description2' => fake()->realText(20),
                        'description3' => fake()->realText(20),
                        'description4' => fake()->realText(20),
                        'description5' => fake()->realText(20),
                        'note' => fake()->realText(20),
                    ]);
                    DB::table('lighting_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'en',
                        'type' => fake()->word(),
                        'color1' => fake()->word(),
                        'color2' => fake()->word(),
                        'color3' => fake()->word(),
                        'power_consumption' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'input' => fake()->randomNumber(),
                        'etc' => fake()->word(),
                        'description1' => fake()->paragraph(1),
                        'description2' => fake()->paragraph(1),
                        'description3' => fake()->paragraph(1),
                        'description4' => fake()->paragraph(1),
                        'description5' => fake()->paragraph(1),
                        'note' => fake()->paragraph(1),
                    ]);
                } else if ($pos==1) {
                    DB::table('controller_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'ja',
                        'type' => fake()->word(),
                        'total_capacity' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'input' => fake()->randomNumber(),
                        'output' => fake()->randomNumber(),
                        'note' => fake()->realText(20),
                        'dimmable_control' => fake()->randomElement(['pwm', 'current', 'voltage', 'overdrive']),
                        'is_ethernet' => fake()->randomElement([0, 1]),
                        'is_8bit_parallel' => fake()->randomElement([0, 1]),
                        'is_10bit_parallel' => fake()->randomElement([0, 1]),
                        'is_rs232c' => fake()->randomElement([0, 1]),
                        'is_analog' => fake()->randomElement([0, 1]),
                        'description1' => fake()->realText(20),
                        'description2' => fake()->realText(20),
                        'description3' => fake()->realText(20),
                        'description4' => fake()->realText(20),
                        'description5' => fake()->realText(20),
                        'note' => fake()->realText(20),
                    ]);
                    DB::table('controller_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'en',
                        'type' => fake()->word(),
                        'total_capacity' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'input' => fake()->randomNumber(),
                        'output' => fake()->randomNumber(),
                        'note' => fake()->realText(20),
                        'dimmable_control' => fake()->randomElement(['pwm', 'current', 'voltage', 'overdrive']),
                        'is_ethernet' => fake()->randomElement([0, 1]),
                        'is_8bit_parallel' => fake()->randomElement([0, 1]),
                        'is_10bit_parallel' => fake()->randomElement([0, 1]),
                        'is_rs232c' => fake()->randomElement([0, 1]),
                        'is_analog' => fake()->randomElement([0, 1]),
                        'description1' => fake()->paragraph(1),
                        'description2' => fake()->paragraph(1),
                        'description3' => fake()->paragraph(1),
                        'description4' => fake()->paragraph(1),
                        'description5' => fake()->paragraph(1),
                        'note' => fake()->paragraph(1),
                    ]);
                } else if ($pos==2) {
                    DB::table('cable_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'ja',
                        'type' => fake()->word(),
                    ]);
                    DB::table('cable_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'en',
                        'type' => fake()->word(),
                    ]);
                    $cable_group[] = $item_id;
                } else if ($pos==3) {
                    DB::table('option_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'ja',
                        'type' => fake()->word(),
                        'throughput' => fake()->randomNumber(),
                    ]);
                    DB::table('option_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'en',
                        'type' => fake()->word(),
                        'throughput' => fake()->randomNumber(),
                    ]);
                }
            }
            if ($pos==2) {
                DB::table('cable_item_groups')->insert([
                    'item_ids' => '['.implode(',', $cable_group).']',
                    'lighting_connector' => fake()->word(),
                    'power_connector' => fake()->word(),
                ]);
                $cable_id = DB::getPdo()->lastInsertId();
                DB::table('cable_item_group_details')->insert([
                    'cable_item_group_id' => $cable_id,
                    'language' => 'ja',
                    'description1' => fake()->realText(20),
                    'description2' => fake()->realText(20),
                    'description3' => fake()->realText(20),
                    'description4' => fake()->realText(20),
                    'description5' => fake()->realText(20),
                    'note' => fake()->realText(20),
                ]);
                DB::table('cable_item_group_details')->insert([
                    'cable_item_group_id' => $cable_id,
                    'language' => 'en',
                    'description1' => fake()->paragraph(1),
                    'description2' => fake()->paragraph(1),
                    'description3' => fake()->paragraph(1),
                    'description4' => fake()->paragraph(1),
                    'description5' => fake()->paragraph(1),
                    'note' => fake()->paragraph(1),
                ]);
            }
        }
    }
}
