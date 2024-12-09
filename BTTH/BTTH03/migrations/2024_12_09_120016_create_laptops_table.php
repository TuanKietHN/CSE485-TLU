<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laptops', function (Blueprint $table) {
            $table->id(); 
            $table->string('brand'); 
            $table->string('model'); 
            $table->text('specifications'); 
            $table->boolean('rental_status'); 
            $table->foreignId('renter_id')->nullable()->constrained('renters')->onDelete('set null'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laptops');
    }
};
