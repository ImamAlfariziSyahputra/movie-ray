<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authorities = config('permission.authorities');

        $listPermissions = [];

        $superAdminPermissions = [];
        $adminPermissions = [];
        $editorPermissions = [];

        foreach($authorities as $manage => $permissions) {
            foreach($permissions as $permission) {
                $listPermissions[] = [
                    'name' => $permission,
                    'guard_name' => 'web',
                    'created_at' => date('Y:m:d H:i:s'),
                    'updated_at' => date('Y:m:d H:i:s'),
                ];

                // SuperAdmin
                $superAdminPermissions[] = $permission;

                // Admin
                if(in_array($manage, [
                    'manage_movies', 'manage_directors', 'manage_casts', 'manage_genres', 'manage_ratings'
                ])) {
                    $adminPermissions[] = $permission;
                }

                // Editor
                if(in_array($manage, ['manage_movies'])) {
                    $editorPermissions[] = $permission;
                }
            }
        }

        // Todo:Insert All Permissions
        Permission::insert($listPermissions);

        // TODO:Insert Role
        // SuperAdmin
        $superAdmin = Role::create([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
            'created_at' => date('Y:m:d H:i:s'),
            'updated_at' => date('Y:m:d H:i:s'),
        ]);

        // Admin
        $admin = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web',
            'created_at' => date('Y:m:d H:i:s'),
            'updated_at' => date('Y:m:d H:i:s'),
        ]);
        // Editor
        $editor = Role::create([
            'name' => 'Editor',
            'guard_name' => 'web',
            'created_at' => date('Y:m:d H:i:s'),
            'updated_at' => date('Y:m:d H:i:s'),
        ]);

        // TODO: Give Permission for each Role
        $superAdmin->givePermissionTo($superAdminPermissions);
        $admin->givePermissionTo($adminPermissions);
        $editor->givePermissionTo($editorPermissions);

        // TODO: Give Role to User
        $userSuperAdmin = User::find(1)->assignRole('SuperAdmin');
    }
}
