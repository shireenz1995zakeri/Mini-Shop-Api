<?php

namespace Database\Seeders;

use App\Enum\PermissionEnum;
use App\Enum\RoleEnum;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
class RolePermissionSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (RoleEnum::cases() as $caseRole) {
            Role::firstOrCreate([
                'name' => $caseRole->value,
            ]);
            //->givePermissionTo($case);

        }
        $admin=Role::where('name','admin')->first();

        foreach (PermissionEnum::cases() as $case){
            Permission::firstOrCreate([
                'name'=>$case->value,
            ]);

            $admin->givePermissionTo($case->value);
        }

    }
}
