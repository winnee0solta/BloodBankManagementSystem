<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('image')->default('no');
            $table->string('name');
            $table->string('contact');
            $table->string('age');
            $table->string('blood_group');
            $table->string('gender');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_infos');
    }
}
