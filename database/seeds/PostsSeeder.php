<?php

use App\Models\Forum;
use App\Models\Post;

class PostsSeeder extends BaseSeeder
{
    /**
     * Run fake seeds - for non production environments
     *
     * @return mixed
     */
    public function runFake() {
        $forums = Forum::all();

        foreach ($forums as $forum) {
            for ($i = 0; $i < 10; ++$i) {
                Post::create([
                    'forum_id' => $forum->getKey(),
                    'topic' => implode(' ', $this->faker->words(3)),
                    'content' => $this->faker->paragraph(3),
                ]);
            }
        }
    }

    /**
     * Run seeds to be ran only on production environments
     *
     * @return mixed
     */
    public function runProduction() {

    }

    /**
     * Run seeds to be ran on every environment (including production)
     *
     * @return mixed
     */
    public function runAlways() {

    }
}
