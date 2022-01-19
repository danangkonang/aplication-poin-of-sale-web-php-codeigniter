<?php


use Phinx\Seed\AbstractSeed;

class UsersPermision extends AbstractSeed
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
        'user_id' => 1,
        'read' => true,
        'create' => true,
        'update' => true,
        'delete' => true,
      ),
      array(
        'user_id' => 2,
        'read' => true,
        'create' => false,
        'update' => false,
        'delete' => false,
      ),
      array(
        'user_id' => 3,
        'read' => true,
        'create' => true,
        'update' => false,
        'delete' => false,
      ),
    );

    $permision = $this->table('permisions');
    $permision->insert($data)->save();
  }
}
