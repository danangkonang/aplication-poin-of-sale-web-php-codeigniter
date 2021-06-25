<?php


use Phinx\Seed\AbstractSeed;

class Store extends AbstractSeed
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
            'store_name' => 'semoga berkah',
            'store_phone' => '08123123',
            'store_address' => 'jakarta',
            'store_description' => 'Velit ullamco occaecat exercitation nisi exercitation do reprehenderit eiusmod dolore ipsum duis exercitation.',
        ),
      );

      $store = $this->table('store');
      $store->insert($data)->save();
    }
}
