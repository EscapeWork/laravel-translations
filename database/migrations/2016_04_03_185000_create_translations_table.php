<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->integer('model_id')->unsigned();
            $table->string('locale', 5);
            $table->string('slug')->nullable()->default(null);
            $table->text('data');
            $table->timestamps();

            $table->foreign('locale')->references('id')->on('locales')
                  ->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('translations');
    }
}
