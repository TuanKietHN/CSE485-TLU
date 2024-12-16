<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssuesController;

// Hiển thị danh sách vấn đề (trang chủ)
Route::get('/', [IssuesController::class, 'index'])->name('issues.index');

// Tạo mới một vấn đề (hiển thị form thêm mới)
Route::get('/issues/create', [IssuesController::class, 'create'])->name('issues.create');

// Lưu dữ liệu của vấn đề mới (thực hiện thêm mới)
Route::post('/issues', [IssuesController::class, 'store'])->name('issues.store');

// Hiển thị chi tiết một vấn đề (tuỳ chọn)
Route::get('/issues/{id}', [IssuesController::class, 'show'])->name('issues.show');

// Chỉnh sửa thông tin của vấn đề (hiển thị form chỉnh sửa)
Route::get('/issues/{id}/edit', [IssuesController::class, 'edit'])->name('issues.edit');

// Cập nhật thông tin của vấn đề (thực hiện cập nhật)
Route::put('/issues/{id}', [IssuesController::class, 'update'])->name('issues.update');

// Xóa vấn đề (thực hiện xóa sau khi có xác nhận)
Route::delete('/issues/{id}', [IssuesController::class, 'destroy'])->name('issues.destroy');
