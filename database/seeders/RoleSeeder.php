<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'super-admin',
            'abilities' => [
                'users.index',
                'users.view',
                'users.create',
                'users.update',
                'users.delete',

                'categories.index',
                'categories.view',
                'categories.create',
                'categories.update',
                'categories.delete',
                'categories.restore',
                'categories.force-delete',

                'products.index',
                'products.view',
                'products.create',
                'products.update',
                'products.delete',
                'products.restore',
                'products.force-delete',

                'roles.index',
                'roles.view',
                'roles.create',
                'roles.update',
                'roles.delete',
            ]
        ]);
    }
}
