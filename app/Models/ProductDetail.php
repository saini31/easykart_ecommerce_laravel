<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_details'; // Specify the table name if it's different from the model's plural name

    protected $fillable = [
        'title',
        'product_id',
        
        'total_items',
        'description',
        // Add other attributes that you want to allow mass assignment for
    ];
}
