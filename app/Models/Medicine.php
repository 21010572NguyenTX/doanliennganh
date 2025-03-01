<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    // Nếu bảng trong database là "medicine" thì khai báo dưới đây, nếu là "medicines" thì có thể bỏ dòng này.
    protected $table = 'cleaned_medicine_details';

    // Khai báo các cột có thể được gán giá trị hàng loạt (mass assignment)
    protected $fillable = [
        'medicine_name',
        'composition',
        'uses',
        'side_effects',
        'image_url',
        'manufacturer',
        'excellent_review_percent',
        'average_review_percent',
        'poor_review_percent',
    ];
}
