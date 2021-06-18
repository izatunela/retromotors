<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GalleryCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('gallery_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('parent_id')->nullable()->default(0);
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('gallery_id')->references('id')->on('gallery');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('parent_id')->references('id')->on('gallery_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery_comments');
    }
}
