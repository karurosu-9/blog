<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * PostsTags seed.
 */
class PostsTagsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'post_id' => 1,
                'tag_id' =>2,
            ],
            [
                'post_id' => 2,
                'tag_id' => 3,
            ],
            [
                'post_id' => 3,
                'tag_id' =>1,
            ],
            [
                'post_id' => 2,
                'tag_id' => 1,
            ],
            [
                'post_id' => 5,
                'tag_id' => 5,
            ],

        ];

        $table = $this->table('posts_tags');
        $table->insert($data)->save();
    }
}
