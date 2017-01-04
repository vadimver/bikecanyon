<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {

            $table->increments('id_publication');
            $table->integer('id_profile');
            $table->integer('id_user');
            $table->text('text');
            $table->string('img');
            $table->string('video');
            $table->integer('likes');
            $table->string('tags');
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
        //
    }
}
