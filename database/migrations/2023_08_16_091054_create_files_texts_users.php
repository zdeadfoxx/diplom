<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTextsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files_texts_users', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('file_id')->nullable()->constrained('files');
            $table->foreignId('text_id')->nullable()->constrained('texts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_texts_users');
    }
}
