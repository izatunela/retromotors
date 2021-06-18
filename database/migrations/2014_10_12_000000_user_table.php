<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_slug')->unique();
            $table->string('name')->unique();
            $table->unsignedInteger('role_id');
            $table->string('email')->unique();
            $table->string('phone',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('password');
            $table->string('confirmation_code')->nullable();
            $table->boolean('status')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
