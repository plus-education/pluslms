<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradebookRowUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradebook_row_user', function (Blueprint $table) {
            $table->foreignId('gradebook_row_id');
            $table->foreignId('user_id');
            $table->text('comment')->nullable();
            $table->unsignedDecimal('score')->default(0);
            $table->string('file')->nullable();
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
        Schema::dropIfExists('gradebook_row_user');
    }
}
