<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title'    => '科技新聞',
            'content'  => '這是一個科技版新聞',
            'field_id' => 1,
            'user_id'  => 1,
        ]);

        Post::create([
            'title'  => '體育新聞',
            'content' => '這是一個體育新聞',
            'field_id' => 2,
            'user_id'  => 2,
        ]);

        Post::create([
            'title'  => '娛樂新聞',
            'content' => '這是一個娛樂新聞',
            'field_id' => 3,
            'user_id'  => 3,
        ]);
    }
}
