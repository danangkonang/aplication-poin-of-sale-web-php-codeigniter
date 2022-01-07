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
                'kind_name' => 'drink',
            ),
            array(
                'kind_name' => 'food'
            ),
          );
    
          $user = $this->table('kind_product');
          $user->insert($data)->save();
    }
}
