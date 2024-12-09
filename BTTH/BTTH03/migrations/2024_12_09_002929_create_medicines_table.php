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
        Schema::create('medicines', function (Blueprint $table) {
            $table->unsignedBigInteger('medicine_id')->primary(); // Khóa chính
            $table->string('brand', 100); // Cột brand kiểu VARCHAR, giới hạn 100 ký tự
            $table->string('dosage', 50); // Cột dosage kiểu VARCHAR, giới hạn 50 ký tự
            $table->string('form', 100); // Cột brand kiểu VARCHAR, giới hạn 100 ký tự
            $table->decimal('price', 10, 2); // Cột price kiểu DECIMAL, 10 số và 2 chữ số thập phân
            $table->integer('stock'); // Cột stock kiểu INT
            $table->timestamps(); // Tạo 2 cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
