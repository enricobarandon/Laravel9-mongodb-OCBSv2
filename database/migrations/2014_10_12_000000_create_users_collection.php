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
            $collection->integer('groupId');
            $collection->boolean('isActive')->default(1);
            $collection->integer('userTypeId');
            $collection->string('firstName');
            $collection->string('middleName');
            $collection->string('lastName');
            $collection->string('contact', 50);
            $collection->string('email')->unique();
            $collection->timestamp('emailVerifiedAt')->nullable();
            $collection->string('password');
            $collection->char('pin', 6);
            $collection->char('allowedSides', 10);
            $collection->integer('maxBet');
            $collection->integer('maxDrawBet');
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
