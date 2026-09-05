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
        Schema::table('schedules', function (Blueprint $table) {
            $table->unsignedInteger('qouta')->default(15)->after('date');
            $table->unsignedInteger('slot_duration_minutes')->default(30)->after('quota');
            $table->unsignedInteger('slot_capacity')->nullable()->after('slot_duration_minutes');
            $table->boolean('is_active')->default(true)->after('slot_capacity');
            $table->softDeletes();
            // 'flag' becomes unused going forware - leave the column for now, drop it in later clean up migration once confirmed nothing else reads it
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
