<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtConnects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('mode_id');
            $table->unsignedBigInteger('gang_id');
            // $table->unsignedBigInteger('invoice_line_id');
            // $table->unsignedBigInteger('status_id');
            $table->timestamps();
        });

        Schema::table('connects', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('cascade');
            $table->foreign('gang_id')->references('id')->on('gangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('connects');
    }
}
