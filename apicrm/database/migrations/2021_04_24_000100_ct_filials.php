<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtFilials extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_id');
            $table->unsignedBigInteger('company_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('filials', function($table) {
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filials');
    }
}
