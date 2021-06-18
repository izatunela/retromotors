<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User;
        $admin->name_slug = 'retroadmin';
        $admin->name = 'RetroAdmin';
        $admin->role_id = 1;
        $admin->email = 'retroadmin@retromotors.com';
        $admin->phone = '';
        $admin->password = bcrypt('123');
        $admin->status = true;
        $admin->save();
    }
}
