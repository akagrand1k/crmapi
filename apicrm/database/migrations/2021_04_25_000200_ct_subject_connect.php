<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtSubjectConnect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO связь через таблицу role_user
        Schema::create('subject_connect', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            // $table->unsignedBigInteger('role_user_id');
            $table->unsignedBigInteger('connect_type');
            $table->unsignedBigInteger('connect_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('subject_connect', function($table) {
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            // $table->foreign('role_user_id')->references('id')->on('role_user')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_connect');
    }
}
