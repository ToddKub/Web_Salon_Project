<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if 'comments' table does not exist before creating
        if (!Schema::hasTable('comments')) {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('booking_id');
                $table->unsignedBigInteger('user_id');
                $table->string('name');
                $table->string('email');
                $table->string('service');
                $table->string('time');
                $table->date('date');
                $table->string('beautician');
                $table->text('comment');
                $table->timestamps();
    
                $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
                
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
