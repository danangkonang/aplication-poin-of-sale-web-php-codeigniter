<?php


use Phinx\Seed\AbstractSeed;

class Zmerchant extends AbstractSeed
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
        'merchant_name' => 'semoga berkah',
        'merchant_telephone' => '08123123',
        'merchant_address' => 'jakarta',
        'merchant_description' => 'Velit ullamco occaecat exercitation nisi exercitation do reprehenderit eiusmod dolore ipsum duis exercitation.',
        'created_by' => 1,
      ),
    );

    $merchant = $this->table('merchants');
    $merchant->insert($data)->save();
  }
}
