<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = "tbl_product";
    protected $fillable = [
        'id',
        'Name',
        'Description',
        'Image',
        'Category',
        'Price',
    ];
}

