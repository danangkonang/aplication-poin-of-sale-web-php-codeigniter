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

      $values = [
        array(
        'barcode' => '8990333811317',
        'kind_id' => 2,
        'product_name' => 'choco pie',
        'purchase_price' => '2000',
        'selling_price' => '4000',
        'unit' => 'pcs',
        'product_qty' => 50,
        'is_promo' => false,
        'product_image' => 'default.jpg',
        'is_active' => true,
        'is_delete' => false,
        'created_by' => 1,
      ),
    ];
    $product = $this->table('products');
    $product->insert($values)->save();

    
  }
}
