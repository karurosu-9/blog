<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenTime;

/**
 * Posts seed.
 */
class PostsSeed extends AbstractSeed
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
                'id' => 1,
                'title' => 'test',
                'description' => 'testtest',
                'body' => 'test',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 2,
                'title' => 'test',
                'description' => 'testtest',
                'body' => 'test',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 3,
                'title' => 'test',
                'description' => 'testtest',
                'body' => 'test',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 4,
                'title' => 'test',
                'description' => 'testtest',
                'body' => 'test',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 5,
                'title' => 'test',
                'description' => 'testtest',
                'body' => 'test',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
        ];

        $table = $this->table('posts');
        $table->insert($data)->save();
    }
}
