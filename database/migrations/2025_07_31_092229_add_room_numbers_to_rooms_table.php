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
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('room_number')->unique();
            $table->enum('type', ['standard', 'premium']);
            $table->string('status')->default('available');
        });

        // Insert standard rooms (101-109)
        for ($i = 1; $i <= 9; $i++) {
            DB::table('rooms')->insert([
                'room_number' => '10' . $i,
                'type' => 'standard',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Insert premium rooms (201-202)
        for ($i = 1; $i <= 2; $i++) {
            DB::table('rooms')->insert([
                'room_number' => '20' . $i,
                'type' => 'premium',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove the added columns
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['room_number', 'type', 'status']);
        });

        // Delete all rooms (be careful with this in production!)
        DB::table('rooms')->truncate();
    }
};
