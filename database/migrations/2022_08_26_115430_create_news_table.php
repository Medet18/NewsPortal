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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subadmin_id')->unsigned();
            $table->string('title_of_news');
            $table->string('description_of_news');
            $table->string('photo_of_news');
            $table->date('date_of_news');
            $table->timestamps();

            $table->foreign('subadmin_id')
                ->references('id')->on('subadmins')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
