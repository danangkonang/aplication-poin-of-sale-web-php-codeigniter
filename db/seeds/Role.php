<?php


use Phinx\Seed\AbstractSeed;

class Role extends AbstractSeed
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
        'role' => 'admin',
      ),
      array(
        'role' => 'seller',
      ),
    );

    $role = $this->table('roles');
    $role->insert($data)->save();
  }
}
