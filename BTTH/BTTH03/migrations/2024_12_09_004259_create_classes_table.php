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
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id'); // Khóa chính kiểu INT tự động tăng
            $table->enum('grade_level', ['Pre-K', 'Kindergarten']); // Cột grade_level kiểu ENUM
            $table->string('room_number', 10); // Cột room_number kiểu VARCHAR, giới hạn 10 ký tự
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
