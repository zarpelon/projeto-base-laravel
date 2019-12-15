<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [[
            'id'             => 1,
            'name'           => 'Admin - Ditech',
            'email'          => 'admin@admin.com',
            'password'       => '$2y$10$4ebeL1uF.fjjTU1eyTQH0OTNm2xUHSML.XgYGqLIxiFWCvkFL/NyS',
            'remember_token' => null,
            'created_at'     => '2019-04-15 19:13:32',
            'updated_at'     => '2019-04-15 19:13:32',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
