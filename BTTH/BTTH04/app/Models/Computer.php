<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    // Định nghĩa bảng tương ứng trong cơ sở dữ liệu
    protected $table = 'computers';

    // Các trường có thể gán giá trị (mass assignable)
    protected $fillable = [
        'computer_name', 
        'model', 
        'operating_system', 
        'processor', 
        'memory', 
        'available' 
    ];

    // Quan hệ 1-n: Một máy tính có thể có nhiều vấn đề
    public function issues()
    {
        return $this->hasMany(Issue::class, 'computer_id');
    }
}
