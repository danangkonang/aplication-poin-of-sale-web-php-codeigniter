<?php


use Phinx\Seed\AbstractSeed;

class KindProduct extends AbstractSeed
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
          'kind_name' => 'bahan sembako',
        ),
        array(
          'kind_name' => 'makanan ringan',
        ),
        array(
          'kind_name' => 'minuman',
        ),
        array(
          'kind_name' => 'rokok',
        ),
        array(
          'kind_name' => 'obat-obatan',
        ),
        array(
          'kind_name' => 'alat tulis',
        ),
        array(
          'kind_name' => 'lain-lain',
        ),
      );

      $user = $this->table('kind_products');
      $user->insert($data)->save();
  }
}
