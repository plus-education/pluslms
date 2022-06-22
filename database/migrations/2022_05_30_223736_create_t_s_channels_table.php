<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Course;
use App\Models\User;

class CreateTSChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_s_channels', function (Blueprint $table) {
            $table->id();
            $table->string('manage_api_key', 254);  // Allows us to delete later
            $table->string('api_key', 254)->unique();
            $table->string('channel_id', 254)->unique();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Course::class);
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
        Schema::dropIfExists('t_s_channels');
    }
}
