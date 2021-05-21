<?php


use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
      $data = array(
        array(
            'username' => 'admin',
            'email' => 'admin@email.com',
            'address' => 'jakarta',
            'is_active' => true,
            'password' => password_hash('admin', PASSWORD_DEFAULT)
        ),
        array(
            'username' => 'user',
            'email' => 'user@email.com',
            'address' => 'surabaya',
            'is_active' => true,
            'password' => password_hash("user", PASSWORD_BCRYPT)
        ),
      );

      $user = $this->table('users');
      $user->insert($data)->save();
    }
}
