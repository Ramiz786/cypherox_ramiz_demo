<?php

namespace Database\Seeders;
use App\Models\ProductModel;
use App\Models\CategoryModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = CategoryModel::where('Name','General')->first();
        if(!empty($category)){
            ProductModel::firstOrCreate(
                [
                    'Name' => 'General Product',
                    'Description' => 'General Product Description',
                    'Image' => 'General.jpg',
                    'Category' => $category->id,
                    'Price' => 10.00,
                ]
            );
        }else{
            $category_id = CategoryModel::firstOrCreate(
                [
                    'Name' => 'General',
                    'Parent' => 0,
                ]
            );
            ProductModel::firstOrCreate(
                [
                    'Name' => 'General',
                    'Parent' => $category_id,
                ]
            );
        }
        
    }
}
