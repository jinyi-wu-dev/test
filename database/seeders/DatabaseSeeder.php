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

        DB::table('icons')->insert(['title'=>'強制空冷']);
        DB::table('icons')->insert(['title'=>'自然空冷']);
        DB::table('icons')->insert(['title'=>'意匠登録済み']);
        DB::table('icons')->insert(['title'=>'特殊光学設計']);
        DB::table('icons')->insert(['title'=>'PowerLED']);
        DB::table('icons')->insert(['title'=>'UKCA']);
        DB::table('icons')->insert(['title'=>'CE']);
        DB::table('icons')->insert(['title'=>'PSE']);
        DB::table('icons')->insert(['title'=>'GigE']);
        for ($i=1; $i<=10; $i++) {
            DB::table('icons')->insert(['title' => 'icon'.$i]);
        }

        $this->insertFeature('horizontal', '自然空冷で業界最高クラスの180万lx！', '他シリーズとの明るさ比較（照射方式：集光、WD：50mmで計測）');
        $this->insertFeature('horizontal', '筐体デザインを一新し、よりコンパクトに', 'デザインを一新し、照明高さ方向で3㎜/照明長さ方向で10㎜のコンパクト化を実現');
        $this->insertFeature('horizontal', '個別調光により均一な照射が可能', "対応電源IMCシリーズにより100mm毎に個別制御が可能なため、状況に合わせた調光制御が可能です。\n更に個別の調光設定を保持したまま全体上下するオフセット調光も搭載しています。 ");
        $this->insertFeature('horizontal', 'IDBB-LSRHシリーズと比べ、約30%の軽量化！', 'デザインを一新し、30％の軽量化を実現');
        for ($i=1; $i<=10; $i++) {
            DB::table('features')->insert([
                'layout' => fake()->randomElement(['vertical', 'horizontal']),
                'title' => '特徴'.$i,
            ]);
            $id = DB::getPdo()->lastInsertId();
            DB::table('feature_details')->insert([
                'feature_id' => $id,
                'language' => 'ja',
                'title' => '特徴'.$i,
                'body' => fake()->realText(10),
            ]);
            DB::table('feature_details')->insert([
                'feature_id' => $id,
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
                    1 => fake()->randomElement(['cr_ac_input', 'cr_dc_input', 'cr_poe_input', 'cr_ex_and_sp']),
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
                'is_logistics' => fake()->randomElement([0, 1]),
                'is_partner' => fake()->randomElement([0, 1]),
                'show_type' => true,
                'show_model' => true,
                'show_product_number' => true,
                'show_weight' => true,
                'show_other' => true,
                'show_compatible_standards' => true,
                'show_luminous_color' => true,
                'show_lt_num_of_ch' => true,
                'show_power_consumption' => true,
                'show_sag' => true,
                'show_input_voltage' => true,
                'show_dimming_controll' => true,
                'show_total_capacity' => true,
                'show_ct_num_of_ch' => true,
                'show_input' => true,
                'show_output' => true,
                'show_external_onoff' => true,
                'show_external_dimming_control' => true,
                'show_throughput' => true,
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
                    'is_new' => $pos==2 ? 0 : fake()->randomElement([0, 1]),
                    'is_end' => $pos==2 ? 0 : fake()->randomElement([0, 1]),
                    'is_publish' => $pos==2 ? 1 : fake()->randomElement([0, 1]),
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
                        'color' => fake()->randomElement(\App\Enums\Color::cases()),
                        'color1' => fake()->word(),
                        'color2' => fake()->word(),
                        'power_consumption' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'sag' => fake()->randomNumber(),
                        'input' => fake()->randomElement([
                            'DC12V',
                            'DC24V',
                            'DC48V',
                            '350mA',
                            '700mA',
                            '1000mA',
                        ]),
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
                        'color' => fake()->randomElement(\App\Enums\Color::cases()),
                        'color1' => fake()->word(),
                        'color2' => fake()->word(),
                        'power_consumption' => fake()->randomNumber(),
                        'num_of_ch' => fake()->randomNumber(),
                        'input' => fake()->randomElement([
                            'DC12V',
                            'DC24V',
                            'DC48V',
                            '350mA',
                            '700mA',
                            '1000mA',
                        ]),
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
                        'input' => fake()->randomElement([
                            'DC12V',
                            'DC24V',
                            'DC48V',
                            '350mA',
                            '700mA',
                            '1000mA',
                        ]),
                        'output' => fake()->randomNumber(),
                        'note' => fake()->realText(20),
                        'dimmable_control' => fake()->randomElement(['pwm', 'variable_current', 'variable_voltage', 'overdrive']),
                        'is_external_switch' => fake()->randomElement([0, 1]),
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
                        'input' => fake()->randomElement([
                            'DC12V',
                            'DC24V',
                            'DC48V',
                            '350mA',
                            '700mA',
                            '1000mA',
                        ]),
                        'output' => fake()->randomNumber(),
                        'note' => fake()->realText(20),
                        'dimmable_control' => fake()->randomElement(['pwm', 'variable_current', 'variable_voltage', 'overdrive']),
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
                        'conditions' => fake()->word(),
                        'length' => fake()->word(),
                    ]);
                    DB::table('cable_items')->insert([
                        'item_id' => $item_id,
                        'language' => 'en',
                        'conditions' => fake()->word(),
                        'length' => fake()->word(),
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
                    'series_id' => $series_id,
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

        for ($i=1; $i<=100; $i++) {
            DB::table('lend_items')->insert([
                'user_id' => fake()->numberBetween(1, 50),
                'remarks' => fake()->realText(20),
                'requested_at' => fake()->dateTime(),
            ]);
            for ($j=1; $j<=fake()->numberBetween(1, 2); $j++) {
                DB::table('lend_item')->insert([
                    'lend_id' => $i,
                    'item_id' => fake()->numberBetween(1, 200),
                    'num_of_item' => fake()->numberBetween(1, 10),
                ]);
            }
        }


    }

    protected function insertFeature($layout, $title, $body) {
        DB::table('features')->insert([
            'layout' => $layout,
            'title' => $title,
        ]);
        $id = DB::getPdo()->lastInsertId();
        DB::table('feature_details')->insert([
            'feature_id' => $id,
            'language' => 'ja',
            'title' => $title,
            'body' => $body,
        ]);
        DB::table('feature_details')->insert([
            'feature_id' => $id,
            'language' => 'en',
            'title' => $title,
            'body' => $body,
        ]);
    }
}
