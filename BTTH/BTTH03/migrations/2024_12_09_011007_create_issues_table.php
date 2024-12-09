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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('computer_id');
            $table->string('reported_by',50)->nullable();
            $table->dateTime('reported_date');
            $table->text('description')->nullable(); // Cột description kiểu TEXT, cho phép NULL
            $table->enum('urgency', ['Low', 'Medium', 'High'])->default('Low'); // Cột urgency kiểu ENUM
            $table->enum('status', ['Open', 'In Progress', 'Resolved'])->default('Open'); // Cột status kiểu ENUM
            $table->timestamps();
            $table->foreign('computer_id')
                ->references('id') // Tham chiếu đến cột medicines_id trong bảng medicines
                ->on('computers')
                ->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
