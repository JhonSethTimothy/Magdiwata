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
        Schema::table('bookings', function (Blueprint $table) {
            $table->enum('payment_method', ['gcash'])->nullable()->after('total_amount');
            $table->string('receipt_path')->nullable()->after('payment_method');
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending')->after('receipt_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'receipt_path', 'payment_status']);
        });
    }
};
