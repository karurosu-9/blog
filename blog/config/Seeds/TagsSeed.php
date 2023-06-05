<?php
declare(strict_types=1);

use Cake\I18n\FrozenTime;
use Migrations\AbstractSeed;

/**
 * Tags seed.
 */
class TagsSeed extends AbstractSeed
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
                'title' => 'タグ1',
                'created' => FrozenTime::now(),
                'modified'=> FrozenTime::now(),
            ],
            [
                'id' => 2,
                'title' => 'タグ2',
                'created' => FrozenTime::now(),
                'modified'=> FrozenTime::now(),
            ],
            [
                'id' => 3,
                'title' => 'タグ3',
                'created' => FrozenTime::now(),
                'modified'=> FrozenTime::now(),
            ],
            [
                'id' => 4,
                'title' => 'タグ4',
                'created' => FrozenTime::now(),
                'modified'=> FrozenTime::now(),
            ],
            [
                'id' => 5,
                'title' => 'タグ5',
                'created' => FrozenTime::now(),
                'modified'=> FrozenTime::now(),
            ],
        ];

        $table = $this->table('tags');
        $table->insert($data)->save();
    }
}
