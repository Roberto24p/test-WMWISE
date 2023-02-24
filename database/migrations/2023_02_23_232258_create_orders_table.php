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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('reference');
            $table->date('date_to_complete_order');
            $table->enum('status', ['not started','in progress', 'completed']);
            $table->text('comments')->default('');
            $table->unsignedBigInteger('person_id');
            $table->boolean('is_delete')->default(false);
            $table->foreign('person_id')->references('id')->on('persons')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
