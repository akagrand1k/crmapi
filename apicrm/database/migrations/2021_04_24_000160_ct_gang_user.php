<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtGangUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gang_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gang_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });

        Schema::table('gang_user', function($table) {
            $table->foreign('gang_id')->references('id')->on('gangs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gang_user');
    }
}
