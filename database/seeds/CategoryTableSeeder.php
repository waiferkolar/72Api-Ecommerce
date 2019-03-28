<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        $file = public_path("files/category.json");
        $json = file_get_contents($file);
        $objs = json_decode($json);

        foreach ($objs as $obj) {
            DB::table('categories')->insert([
                "name" => $obj->name,
            ]);
        }

    }
}
