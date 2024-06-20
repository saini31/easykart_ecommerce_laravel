<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Define the relationship to retrieve products associated with the category
    public function products()
    {
        return $this->hasMany(Product::class); // Assuming category_id is the foreign key in the products table
    }
    public function category(){
        return $this->belongsToMany(Product::class);
    }
}
