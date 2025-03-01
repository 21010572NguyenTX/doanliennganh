<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;

    // Chỉ định tên bảng trong cơ sở dữ liệu
    protected $table = 'cleaned_disease'; // Đảm bảo tên bảng đúng như trong cơ sở dữ liệu của bạn

    // Nếu bảng không sử dụng timestamps (created_at, updated_at)
    public $timestamps = false;

    // Định nghĩa các cột được phép gán dữ liệu
    protected $fillable = [
        'name',           // Tên bệnh
        'description',    // Mô tả bệnh
        'causes',         // Nguyên nhân gây bệnh
        'symptoms',       // Các triệu chứng
        'treatment',      // Cách điều trị
        'prevention'      // Cách phòng ngừa
    ];
}
