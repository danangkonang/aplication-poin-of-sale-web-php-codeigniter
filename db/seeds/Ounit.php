<?php


use Phinx\Seed\AbstractSeed;

class Ounit extends AbstractSeed
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
        'unit' => 'pcs',
      ),
      array(
        'unit' => 'karton',
      ),
      array(
        'unit' => 'liter',
      ),
      array(
        'unit' => 'kg',
      ),
    );

    $user = $this->table('units');
    $user->insert($data)->save();
  }
}
