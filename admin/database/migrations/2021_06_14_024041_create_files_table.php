<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url_size_1');
            $table->string('url_size_2');
                  
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            
            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onDelete('set null');
                // ->onUpdate('set null');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
                // ->onUpdate('set null');

            $table->boolean('state');
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
        Schema::dropIfExists('files');
    }
}
