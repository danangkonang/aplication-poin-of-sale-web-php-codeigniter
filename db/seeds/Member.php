<?php

require_once 'vendor/autoload.php';

use Phinx\Seed\AbstractSeed;

class Member extends AbstractSeed
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
    $faker = Faker\Factory::create('id_ID');
    $values = [];
    for ($i = 0; $i < 1; $i++) {
      $values[] = array(
        'member_name' => 'resa', 
        'member_telephone' => '6289652251589',
        'member_email' =>'resarianti23@gmail.com',
        'created_by' => 1,
      );
    }

    $member = $this->table('members');
    $member->insert($values)->save();
  }
}
