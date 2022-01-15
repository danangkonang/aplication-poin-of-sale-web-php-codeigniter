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
        'user_name' => 'Kasir',
        'email' => 'admin@email.com',
        'address' => 'jakarta',
        'is_active' => true,
        'role' => 'admin',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      ),
      array(
        'user_name' => 'resa23',
        'email' => 'resa23@email.com',
        'address' => 'bandung',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("password", PASSWORD_BCRYPT)
      ),
      array(
        'user_name' => 'user seller',
        'email' => 'seller@email.com',
        'address' => 'surabaya',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("password", PASSWORD_BCRYPT)
      ),
    );

    $user = $this->table('users');
    $user->insert($data)->save();
  }
}
