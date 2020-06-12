<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crea los permisos
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'update post']);
        Permission::create(['name' => 'liker post']);
        Permission::create(['name' => 'delete all post']);
        Permission::create(['name' => 'show all post']);
        Permission::create(['name' => 'update all post']);
        Permission::create(['name' => 'show post']);
        Permission::create(['name' => 'comment']);

        // Crea el role y le asigna los permisos que se crearon anteriormente
        //Se crea el role de Usuario y se le asigna los permisos
        $role1 = Role::create(['name' => 'user']);
        $role1->givePermissionTo('create post');
        $role1->givePermissionTo('delete post');
        $role1->givePermissionTo('update post');
        $role1->givePermissionTo('liker post');
        $role1->givePermissionTo('show post');
        $role1->givePermissionTo('comment');

        //Se crea el role de Aministrador y se le asigna los permisos
        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create post');
        $role2->givePermissionTo('delete post');
        $role2->givePermissionTo('update post');
        $role2->givePermissionTo('liker post');
        $role2->givePermissionTo('delete all post');
        $role2->givePermissionTo('show all post');
        $role2->givePermissionTo('update all post');
        $role2->givePermissionTo('show post');
        $role2->givePermissionTo('comment');
        
        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$XkSKN5WnHrzOHvCsYAmI8er2SBbk0yKAOo7FxsCu.idBJb8OH7hQ6', //Administrador
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'User',
            'email' => 'usu@usu.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$HbVPq5WyrlRcvPmSUNGaNek2Vdy/u5/aflmX5TBG9cwr0Zv5tOQAW', //Soyunusuario
            'remember_token' => Str::random(10),
        ]);
        $user->assignRole($role1);
    }
}
