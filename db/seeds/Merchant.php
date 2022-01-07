<?php


use Phinx\Seed\AbstractSeed;

class Merchant extends AbstractSeed
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
        'merchant_phone' => '08123123',
        'merchant_address' => 'jakarta',
        'merchant_description' => 'Velit ullamco occaecat exercitation nisi exercitation do reprehenderit eiusmod dolore ipsum duis exercitation.',
      ),
    );

    $merchant = $this->table('merchants');
    $merchant->insert($data)->save();
  }
}
