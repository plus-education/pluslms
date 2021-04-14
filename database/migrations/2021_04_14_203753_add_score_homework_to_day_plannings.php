<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddScoreHomeworkToDayPlannings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('day_plannings', function (Blueprint $table) {
            $table->unsignedDecimal('score_homework')->nullable();
            $table->date('homework_start')->nullable();
            $table->date('homework_end')->nullable();
            $table->text('homework_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('day_plannings', function (Blueprint $table) {
            //
        });
    }
}
