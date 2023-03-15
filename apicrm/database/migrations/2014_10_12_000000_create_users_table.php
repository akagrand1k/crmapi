<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            //$table->uuid('uuid')->unique()->index();
            $table->unsignedBigInteger('company_id');
            $table->string('api_token', 108)->unique();
            $table->unsignedBigInteger('old_id');
            $table->string('avatar');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->string('gender', 10)->default('none'); //
            $table->date('birthday');
            // $table->tinyInteger('deleted')->default(0);
            $table->timestamps();

            $table->unique(['phone', 'password']);
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

}
