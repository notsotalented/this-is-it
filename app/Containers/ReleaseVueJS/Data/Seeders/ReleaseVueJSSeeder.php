<?php

namespace App\Containers\ReleaseVueJS\Data\Seeders;

use App\Containers\ReleaseVueJS\Models\ReleaseVueJS;
use App\Ship\Parents\Seeders\Seeder;

class ReleaseVueJSSeeder extends Seeder
{
  public function run()
  {
    for ($j = 1; $j <= 49; $j++) {
      $user = factory(ReleaseVueJS::class)->create([
        'created_at' => date('Y-m-d H:i:s', mt_rand(strtotime('-7 days'), time())),
      ]);
    }

    $user = factory(ReleaseVueJS::class)->create();
  }
}
