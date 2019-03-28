<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTableSeeder extends Seeder
{

    public function run()
    {
        $file = public_path("files/products.json");
        $json = file_get_contents($file);
        $objs = json_decode($json);

        foreach ($objs as $obj) {
            DB::table('products')->insert([
                "id" => $obj->id,
                "cat_id" => $obj->cat_id,
                "name" => $obj->name,
                "price" => $obj->price,
                "image" => $obj->image,
                "description" => $obj->description,
            ]);
        }

    }
}
