<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewsletterImagesTableMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('newsletter_id')->unsigned();
            $table->string('image');
            $table->timestamps();

            $table->foreign('newsletter_id')
                ->references('id')->on('newsletters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('newsletter_images');
    }
}
