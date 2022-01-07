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
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'ayam',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'ayam.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'indomi',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'mie.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'sampo',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'sampo.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'kopi',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'kopi.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'kecap manis',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'kecap.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'pepsoden',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'pepsoden.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'bawang merah',
          'purchase_price' => 5000,
          'selling_price' => 5700,
          'unit' => 'kg',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'bawang.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'sabun mandi',
          'purchase_price' => 2000,
          'selling_price' => 3200,
          'unit' => 'pic',
          'product_qty' => 100,
          'is_promo' => false,
          'product_image' => 'sabun.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'minyak goreng',
          'purchase_price' => 6000,
          'selling_price' => 8000,
          'unit' => 'liter',
          'product_qty' => 150,
          'is_promo' => false,
          'product_image' => 'minyak.png',
          'is_active' => true,
          'is_delete' => false,
        ),
        array(
          'barcode' => '123',
          'kind_id' => '1',
          'product_name' => 'gula pasir',
          'purchase_price' => 3000,
          'selling_price' => 5000,
          'unit' => 'kg',
          'product_qty' => 80,
          'is_promo' => false,
          'product_image' => 'gula.png',
          'is_active' => true,
          'is_delete' => false,
        ),
      );

      $product = $this->table('product');
      $product->insert($data)->save();
    }
}
