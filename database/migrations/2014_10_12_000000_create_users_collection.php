<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $collection) {
            $collection->id();
            $collection->char('uuid', 36)->nullable();
            $collection->integer('group_id');
            $collection->boolean('is_active')->default(1);
            $collection->integer('user_type_id');
            $collection->string('first_name');
            $collection->string('middle_name');
            $collection->string('last_name');
            $collection->string('contact', 50);
            $collection->string('email')->unique();
            $collection->timestamp('email_verified_at')->nullable();
            $collection->string('password');
            $collection->char('pin', 6);
            $collection->char('allowed_sides', 10);
            $collection->integer('max_bet');
            $collection->integer('max_draw_bet');
            $collection->rememberToken();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
