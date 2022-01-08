<?php


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
    $data = array(
      array(
        'barcode' => '123',
        'kind_id' => '1',
        'product_name' => 'telur ayam',
        'purchase_price' => 5000,
        'selling_price' => 5700,
        'unit' => 'kg',
        'product_qty' => 100,
        'is_promo' => false,
        'product_image' => 'telurayam.png',
        'is_active' => true,
        'is_delete' => false,
      ),
    );

    $product = $this->table('products');
    $product->insert($data)->save();
  }
}
