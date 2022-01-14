<?php


use Phinx\Seed\AbstractSeed;

class User extends AbstractSeed
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
        'user_name' => 'admin resa',
        'email' => 'admin@email.com',
        'address' => 'jakarta',
        'is_active' => true,
        'role' => 'admin',
        'password' => password_hash('password', PASSWORD_DEFAULT)
      ),
      array(
        'user_name' => 'user seller',
        'email' => 'seller@email.com',
        'address' => 'bandung',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("password", PASSWORD_BCRYPT)
      ),
      array(
        'user_name' => 'user seller02',
        'email' => 'seller2@email.com',
        'address' => 'jakarta',
        'is_active' => true,
        'role' => 'seller',
        'password' => password_hash("password", PASSWORD_BCRYPT)
      ),
    );

    $user = $this->table('users');
    $user->insert($data)->save();
  }
}
