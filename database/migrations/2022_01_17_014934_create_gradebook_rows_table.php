<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradebookRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradebook_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id');
            $table->string('name');
            $table->boolean('isShow')->default(true);
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->unsignedDecimal('score')->default(0);
            $table->foreignId('activityable_id');
            $table->string('activityable_type');
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
        Schema::dropIfExists('gradebook_rows');
    }
}
