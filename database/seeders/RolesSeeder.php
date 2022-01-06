<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'        => '一般使用者',
            'permissions' => [
                'read_post' => true,
            ]
        ]);
        Role::create([
            'name'        => '編輯者',
            'permissions' => [
                'create_post' => true,
                'update_post' => true,
                'delete_post' => true,
            ]
        ]);
    }
}
