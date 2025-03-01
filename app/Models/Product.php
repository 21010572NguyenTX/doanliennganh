<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Chỉ định tên bảng trong cơ sở dữ liệu
    protected $table = 'cleaned_medicine_details'; // Thay bằng tên bảng của bạn trong phpMyAdmin

    // Nếu bảng không sử dụng timestamps (created_at, updated_at)
    public $timestamps = false;

    // Định nghĩa các cột được phép gán dữ liệu
    protected $fillable = [
        'medicine_name',
        'composition',
        'uses',
        'side_effects',
        'image_url',
        'manufacturer',
        'excellent_review',
        'average_review',
        'poor_review',
    ];
}
