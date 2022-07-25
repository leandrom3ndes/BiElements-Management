<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatebielementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bielements', function(Blueprint $table){
            $table->increments('id');
            $table->integer('eng_id');
            $table->string('bi_name');
            $table->text('bi_desc');
            $table->string('bi_cover_img');
            $table->string('bi_embed');
            $table->integer('bi_type');
            $table->string('bi_base64');
            $table->string('bi_creator');
            $table->string('bi_publish_date');
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
        Schema::dropIfExists('bielements');
    }
}
