<?php

use App\Model\Brand;
use App\Model\Category;
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
        // $brands=Collect(Brand::all()->modelKeys());
        // $categories=Collect(Category::all()->modelKeys());
        // for($i=0;$i<100;$i++){
        //     DB::table('products')->insert([
        //         'name'=>Str::random(10),
        //         'brand_id'=>$brands->random(),
        //         'slug'=>Str::random(10),
        //         'price'=>rand(100,1000),
        //         'special_price'=>rand(100,1000),
        //         'special_price_start'=>null,
        //         'special_price_end'=>null,
        //         'selling_price'=>rand(100,1000),
        //         'sku'=>Str::random(10),
        //         'manage_stock'=>1,
        //         'qty'=>rand(10,30),
        //         'in_stock'=>1,
        //         'viewed'=>0,
        //         'is_active'=>1,
        //         'details'=>Str::random(150),
        //         'special_price_type'=>"",
        //         'category_id'=>$categories->random(),
        //         'sub_category_id'=>0,
        //         'child_category_id'=>0,
        //         'meta_title'=>Str::random(10),
        //         'meta_description'=>Str::random(10),
        //         'image'=>"1604290301.jpeg",
        //         "price_type"=>"fixed",
        //         "is_top"=>rand(0,1),
        //         "is_trending"=>rand(0,1),
        //         "is_hot"=>rand(0,1),
    
        //     ]);
        // }
    }
}
