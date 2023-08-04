<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        Permission::create(['name' => 'register']);
        Permission::create(['name' => 'semaksyarat']);
        Permission::create(['name' => 'daftarlayak']);
        Permission::create(['name' => 'permohonan']);

        Permission::create(['name' => 'saringan']);
        Permission::create(['name' => 'sekretariatSP']);
        Permission::create(['name' => 'sekretariatKP']);

        Permission::create(['name' => 'login']);

        $pelajarRole = Role::create(['name' => 'Pelajar IPTS']);
        $penyelarasRole = Role::create(['name' => 'Penyelaras BKOKU IPT']);
        $sekretariatRole = Role::create(['name' => 'Sekretariat KPT']);
        $pegawaiRole = Role::create(['name' => 'Pegawai Atasan KPT']);

        $pelajarRole->givePermissionTo([
            'login',
            'register',
            'semaksyarat',
            'daftarlayak',
            'permohonan',
        ]);

        $sekretariatRole->givePermissionTo([
            'login',
            'saringan',
            'sekretariatSP',
            'sekretariatKP',
        ]);
    }
}
