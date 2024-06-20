<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeedback extends Model
{
    use HasFactory;
    protected $table = 'product_feedback';

    protected $fillable = ['user_id', 'product_id', 'rating', 'likes', 'feedback'];
}
