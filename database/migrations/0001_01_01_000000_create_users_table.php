<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->default('');
            $table->string('kana')->default('');
            $table->string('post_code', 7)->default('');
            $table->integer('prefecture_id')->nullable();
            $table->string('municipalities')->default('');
            $table->string('block_number')->default('');
            $table->string('building')->default('');
            $table->string('phone_number', 11)->default('');
            $table->string('company')->default('');
            $table->string('department')->default('');
            $table->string('position')->default('');
            $table->string('industry')->default('');
            $table->string('occupation')->default('');
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        /*
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
         */

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('password')->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('icons', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('features', function (Blueprint $table) {
            $table->id();
            $table->enum('layout', ['vertical', 'horizontal'])->nullable();
            $table->string('title')->default('');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('feature_details', function (Blueprint $table) {
            $table->bigInteger('feature_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('title')->default('');
            $table->text('body')->default('');
            $table->timestamps();
            $table->primary(['feature_id', 'language']);
        });

        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['lighting', 'controller', 'cable', 'option'])->nullable();
            $table->enum('genre', [
                'lt_line', 'lt_ring', 'lt_transmission', 'lt_flatsurface', 'lt_dome', 'lt_coaxial-spot', 'lt_other',
                'cr_pwm', 'cr_v_current', 'cr_v_voltage', 'cr_overdrive',
                'cb_lighting', 'cb_external',
                'op_lighting', 'op_other'
            ])->nullable();
            $table->string('model')->default('');
            $table->boolean('is_new')->default(false);
            $table->boolean('is_end')->default(false);
            $table->boolean('is_publish')->default(false);

            $table->boolean('show_type')->default(false);
            $table->boolean('show_model')->default(false);
            $table->boolean('show_product_number')->default(false);
            $table->boolean('show_weight')->default(false);
            $table->boolean('show_other')->default(false);
            $table->boolean('show_compatible_standards')->default(false);

            $table->boolean('show_luminous_color')->default(false);
            $table->boolean('show_lt_num_of_ch')->default(false);
            $table->boolean('show_power_consumption')->default(false);
            $table->boolean('show_seg')->default(false);
            $table->boolean('show_input_voltage')->default(false);

            $table->boolean('show_diming_controll')->default(false);
            $table->boolean('show_total_capacity')->default(false);
            $table->boolean('show_ct_num_of_ch')->default(false);
            $table->boolean('show_input')->default(false);
            $table->boolean('show_output')->default(false);
            $table->boolean('show_external_onoff')->default(false);
            $table->boolean('show_external_diming_control')->default(false);
            $table->boolean('show_throughput')->default(false);
            $table->text('memo')->default('');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });

        Schema::create('series_details', function (Blueprint $table) {
            $table->bigInteger('series_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('name')->default('');
            $table->string('model')->default('');
            $table->string('body1')->default('');
            $table->string('body2')->default('');
            $table->string('body3')->default('');
            $table->string('note')->default('');
            $table->timestamps();
            $table->primary(['series_id', 'language']);
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('series_id')->unsigned();
            $table->boolean('is_new')->nullable()->default(false);
            $table->boolean('is_end')->nullable()->default(false);
            $table->boolean('is_publish')->nullable()->default(false);
            $table->boolean('is_lend')->nullable()->default(false);
            $table->string('model')->nullable();
            $table->string('product_number')->default('');
            $table->string('operating_temperature')->default('');
            $table->string('operating_humidity')->default('');
            $table->string('weight')->default('');
            $table->boolean('is_RoHS')->default(false);
            $table->boolean('is_RoHS2')->default(false);
            $table->boolean('is_CN_RoHSe1')->default(false);
            $table->boolean('is_CN_RoHS102')->default(false);
            $table->boolean('is_CE_IEC')->default(false);
            $table->boolean('is_UKCA')->default(false);
            $table->boolean('is_PSE')->default(false);
            $table->text('memo')->default('');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
            
        Schema::create('lighting_items', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('type')->default('');
            $table->string('color1')->default('');
            $table->string('color2')->default('');
            $table->string('color3')->default('');
            $table->string('power_consumption')->default('');
            $table->string('num_of_ch')->default('');
            $table->string('input')->default('');
            $table->string('etc')->default('');
            $table->string('description1')->default('');
            $table->string('description2')->default('');
            $table->string('description3')->default('');
            $table->string('description4')->default('');
            $table->string('description5')->default('');
            $table->string('note')->default('');
            $table->timestamps();
            $table->primary(['item_id', 'language']);
        });

        Schema::create('controller_items', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('type')->default('');
            $table->string('total_capacity')->default('');
            $table->string('num_of_ch')->default('');
            $table->string('input')->default('');
            $table->string('output')->default('');
            $table->enum('dimmable_control', ['pwm', 'variable_current', 'variable_voltage', 'overdrive'])->nullable();
            $table->boolean('external_control');
            $table->boolean('is_ethernet');
            $table->boolean('is_8bit_parallel');
            $table->boolean('is_10bit_parallel');
            $table->boolean('is_rs232c');
            $table->boolean('is_analog');
            $table->string('description1')->default('');
            $table->string('description2')->default('');
            $table->string('description3')->default('');
            $table->string('description4')->default('');
            $table->string('description5')->default('');
            $table->string('note')->default('');
            $table->timestamps();
            $table->primary(['item_id', 'language']);
        });

        Schema::create('cable_items', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('type')->default('');
            $table->timestamps();
            $table->primary(['item_id', 'language']);
        });

        Schema::create('cable_item_groups', function (Blueprint $table) {
            $table->id();
            $table->string('item_ids')->default('');
            $table->string('lighting_connector')->default('');
            $table->string('power_connector')->default('');
            $table->timestamps();
        });

        Schema::create('cable_item_group_details', function (Blueprint $table) {
            $table->bigInteger('cable_item_group_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('description1')->default('');
            $table->string('description2')->default('');
            $table->string('description3')->default('');
            $table->string('description4')->default('');
            $table->string('description5')->default('');
            $table->string('note')->default('');
            $table->timestamps();
            $table->primary(['cable_item_group_id', 'language']);
        });

        Schema::create('option_items', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->enum('language', ['jp', 'en'])->default('jp');
            $table->string('type')->default('');
            $table->string('throughput')->default('');
            $table->string('description1')->default('');
            $table->string('description2')->default('');
            $table->string('description3')->default('');
            $table->string('description4')->default('');
            $table->string('description5')->default('');
            $table->string('note')->default('');
            $table->timestamps();
            $table->primary(['item_id', 'language']);
        });

        Schema::create('lend_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable(false);
            $table->enum('category', ['lighting', 'controller', 'cable', 'option'])->nullable(false);
            $table->bigInteger('item_id')->nullable(false);
            $table->datetime('request_at');
            $table->timestamps();
        });

        Schema::create('series_icon', function (Blueprint $table) {
            $table->bigInteger('series_id')->nullable(false);
            $table->bigInteger('icon_id')->nullable(false);
            $table->timestamps();
            $table->primary(['series_id', 'icon_id']);
        });

        Schema::create('series_feature', function (Blueprint $table) {
            $table->bigInteger('series_id')->unsigned();
            $table->bigInteger('feature_id')->unsigned();
            $table->timestamps();
            $table->primary(['series_id', 'feature_id']);
        });

        Schema::create('item_series', function (Blueprint $table) {
            $table->bigInteger('item_id')->unsigned();
            $table->bigInteger('series_id')->unsigned();
            $table->enum('category', ['lighting', 'controller', 'cable', 'option'])->nullable(false);
            $table->timestamps();
            $table->primary(['item_id', 'series_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');

        Schema::dropIfExists('admins');
    }
};
