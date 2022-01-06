<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::create([
            'name' => '科技',
        ]);
        Field::create([
            'name' => '體育',
        ]);
        Field::create([
            'name' => '娛樂',
        ]);
    }
}
