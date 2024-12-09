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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('sale_id'); // Khóa chính tự động tăng
            $table->unsignedBigInteger('medicine_id'); // Thay đổi từ unsignedInteger thành unsignedBigInteger
            $table->integer('quantity');
            $table->dateTime('sale_date'); // Cột ngày bán
            $table->string('customer_phone', 10)->nullable(); // Cột số điện thoại khách hàng, cho phép NULL
            $table->timestamps(); // Tạo cột created_at và updated_at

            // Khai báo khóa ngoại
            $table->foreign('medicine_id')
                ->references('medicine_id') // Tham chiếu đến cột medicine_id trong bảng medicines
                ->on('medicines')
                ->onDelete('cascade'); // Xóa bản ghi nếu bản ghi liên quan trong medicines bị xóa
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
