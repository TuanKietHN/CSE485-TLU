<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Thêm Carbon để dễ dàng xử lý ngày tháng

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales')->insert([
            [
                'sale_id' => 1,
                'medicine_id' => 1, // ID của medicine đã được tạo trong bảng medicines
                'quantity' => 10,
                'sale_date' => Carbon::now(),
                'customer_phone' => '0987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 2,
                'medicine_id' => 2, // ID của medicine đã được tạo trong bảng medicines
                'quantity' => 5,
                'sale_date' => Carbon::now()->subDays(1),
                'customer_phone' => '0912345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 3,
                'medicine_id' => 3, // ID của medicine đã được tạo trong bảng medicines
                'quantity' => 3,
                'sale_date' => Carbon::now()->subDays(2),
                'customer_phone' => null, // Nếu không có số điện thoại
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm các bản ghi mẫu khác nếu cần
        ]);
    }
}
