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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('rateplan_id')->constrained()->onDelete('cascade');
            $table->foreignId('calendar_id')->constrained()->onDelete('cascade');
            $table->string('reservation_number');
            $table->date('reservation_date');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('country');
            $table->decimal('total', 10, 2);
            $table->string('payment_status');
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
        Schema::dropIfExists('bookings');
    }
};
