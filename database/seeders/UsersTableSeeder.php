<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() === 0) {
            $admin = Role::where('name', 'admin')->firstOrFail();
            $staff = Role::where('name', 'staff')->firstOrFail();
            $user  = Role::where('name', 'user')->firstOrFail();
            User::create([
                'name'           => 'Admin',
                'email'          => 'bleuren@hotmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $admin->id,
            ]);

            User::create([
                'name'           => 'Staff',
                'email'          => 'staff@staff.staff',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $staff->id,
            ]);

            User::create([
                'name'           => 'User',
                'email'          => 'user@user.user',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'        => $user->id,
            ]);
        }
    }
}
