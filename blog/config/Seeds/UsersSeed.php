<?php
declare(strict_types=1);

use Migrations\AbstractSeed;
use Cake\I18n\FrozenTime;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
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
                'username' => 'Taro',
                'password' => 'abc',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 2,
                'username' => 'Hanako',
                'password' => 'abc',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
            [
                'id' => 3,
                'username' => 'John',
                'password' => 'abc',
                'created' => FrozenTime::now(),
                'modified' => FrozenTime::now(),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
