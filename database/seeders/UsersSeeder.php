<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'account'  => 'test01',
            'password' => '123456',
            'field_id' => 1,
        ]);

        User::create([
            'account'  => 'test02',
            'password' => '123456',
            'field_id' => 2,
        ]);

        User::create([
            'account'  => 'test03',
            'password' => '123456',
            'field_id' => 3,
        ]);
    }
}
