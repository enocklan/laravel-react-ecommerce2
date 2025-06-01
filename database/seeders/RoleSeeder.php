<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $VendorRole = Role::create(['name' => RolesEnum::Vendor->value]);
        $AdminRole = Role::create(['name' => RolesEnum::Admin->value]);

        $approveVendors = Permission::create([
            'name' => PermissionsEnum::ApproveVendors->value
        ]);
        $sellProducts = Permission::create([
            'name' => PermissionsEnum::SellProducts->value
        ]);
        $buyProducts = Permission::create([
            'name' => PermissionsEnum::BuyProducts->value
        ]);
        $userRole->syncPermissions([$buyProducts]);
        $VendorRole->syncPermissions([$buyProducts, $sellProducts]);
        $AdminRole->syncPermissions([$buyProducts, $sellProducts, $approveVendors]);
    }
}

