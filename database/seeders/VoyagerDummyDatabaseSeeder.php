<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyagerDummyDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MapsTableSeeder::class,
            OrdersTableSeeder::class,
            TranslationsTableSeeder::class,
            PermissionRoleTableSeeder::class,
        ]);
    }
}
