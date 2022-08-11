<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKnowagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('documentLabel');
            $table->string('documentName');
            $table->string('knowage_cover_img');
            $table->string('knowage_base64');
            $table->string('documentType');
            $table->text('documentDescription');
            $table->string('executionRole');
            $table->string('displayToolbar');
            $table->string('canResetParameters');
            $table->string('displaySliders');
            $table->string('datasetLabel');
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
        Schema::dropIfExists('knowages');
    }
}
