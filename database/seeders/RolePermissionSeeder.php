<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shipmentUpdateID = Permission::where('name', 'shipment.update')->value('id');

        $roleAgen = Role::find(2);
        $roleAgen->permissions()->sync([1, 2, 21, 22, 23, $shipmentUpdateID]);
    }
}
