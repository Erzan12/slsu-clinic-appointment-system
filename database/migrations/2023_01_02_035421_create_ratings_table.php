<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->smallInteger('responsiveness');
            $table->smallInteger('reliability');
            $table->smallInteger('access_and_facility');
            $table->smallInteger('costs');
            $table->smallInteger('integrity');
            $table->smallInteger('communication');
            $table->smallInteger('assurance');
            $table->smallInteger('outcome');
            $table->text('suggestion')->nullable();
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
        Schema::dropIfExists('ratings');
    }
};
