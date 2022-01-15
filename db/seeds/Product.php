<?php

require_once 'vendor/autoload.php';

use Phinx\Seed\AbstractSeed;

class Product extends AbstractSeed
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
    $faker = Faker\Factory::create();

    $values = [];
    for ($i = 0; $i < 100; $i++) {
      $values []= array(
        'barcode' => $faker->ean13,
        'kind_id' => $faker->randomElement($array = array (1, 2, 3, 4, 5, 6, 7)),
        'product_name' => $faker->country,
        'purchase_price' => $faker->randomElement($array = array (1000, 1500, 2000)),
        'selling_price' => $faker->randomElement($array = array (2000, 2500, 3000)),
        'unit' => $faker->randomElement($array = array ('kg', 'pcs', 'karton', 'liter')),
        'product_qty' => $faker->numberBetween($min = 10, $max = 100),
        'is_promo' => false,
        'product_image' => 'default.jpg',
        'is_active' => true,
        'is_delete' => false,
        'created_by' => 1,
      );
    }

    $product = $this->table('products');
    $product->insert($values)->save();
  }
}
