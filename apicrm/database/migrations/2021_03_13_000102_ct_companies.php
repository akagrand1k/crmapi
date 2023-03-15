<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CtCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
          $table->id();
          // $table->unsignedBigInteger('old_id')->unique();
          $table->unsignedBigInteger('old_id');
          $table->string('name');
          $table->string('city')->default('');
          $table->string('address')->default('');
          //$table->unsignedBigInteger('identity_id');
          $table->timestamps();
        });

        Schema::table('users', function($table) {
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
        Schema::dropIfExists('companies');
    }
}
