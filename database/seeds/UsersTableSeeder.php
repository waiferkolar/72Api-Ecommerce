<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $file = public_path("files/users.json");
        $json = file_get_contents($file);
        $objs = json_decode($json);

        foreach ($objs as $obj) {
            DB::table('users')->insert([
                "name" => $obj->name,
                "email" => $obj->email,
                "password" => bcrypt($obj->password)
            ]);
        }

    }
}
