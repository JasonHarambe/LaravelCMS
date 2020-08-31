<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::create(['name' => 'admin']);

        $user = Factory(App\User::class)->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('adminpassword'),
        ]);

        $user->assignRole($adminRole);
    }
}
