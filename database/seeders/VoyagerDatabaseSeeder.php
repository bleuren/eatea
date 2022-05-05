<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VoyagerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DataTypesTableSeeder::class,
            DataRowsTableSeeder::class,
            MenusTableSeeder::class,
            MenuItemsTableSeeder::class,
            MenuItemsAdminTableSeeder::class,
            MenuItemsStaffTableSeeder::class,
            MenuItemsUserTableSeeder::class,
            MenuItemsMainTableSeeder::class,
            RolesTableSeeder::class,
            PermissionsTableSeeder::class,
            SettingsTableSeeder::class,
            CategoriesBreadSeeder::class,
            PostsBreadSeeder::class,
            PagesBreadSeeder::class,
            CarouselsBreadSeeder::class,
            ProductsBreadSeeder::class,
            OrdersBreadSeeder::class,
            OrderItemsBreadSeeder::class,
            OrderItemSubsBreadSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
            PagesTableSeeder::class,
            CarouselsTableSeeder::class,
            ProductsTableSeeder::class,
            MapsTableSeeder::class,
            OrdersTableSeeder::class,
            PermissionRoleTableSeeder::class,
        ]);
    }
}
