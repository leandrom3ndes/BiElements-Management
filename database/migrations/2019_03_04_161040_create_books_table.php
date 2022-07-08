<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function(Blueprint $table){
            $table->increments('id');
            $table->integer('eng_id');
            $table->string('book_name');
            $table->text('book_desc');
            $table->string('book_cover_img');
            $table->string('book_pdf');
            $table->integer('book_price');
            $table->string('book_author');
            $table->string('book_publisher');
            $table->string('book_publish_date');
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
        Schema::dropIfExists('books');
    }
}
