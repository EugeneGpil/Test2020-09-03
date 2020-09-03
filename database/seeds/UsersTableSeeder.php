<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create admin
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@mail.loc';
        $admin->password = bcrypt('admin');
        $admin->save();

        // create user
        $user = new User();
        $user->name = 'user';
        $user->email = 'user@mail.loc';
        $user->password = bcrypt('user');
        $user->save();

        // create users
        $newUsersCount = rand(10, 30);
        factory(User::class, $newUsersCount)->create();
    }
}
