<?php

namespace Database\Seeders;

use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_adviser","view_any_adviser","create_adviser","update_adviser","restore_adviser","restore_any_adviser","replicate_adviser","reorder_adviser","delete_adviser","delete_any_adviser","force_delete_adviser","force_delete_any_adviser","view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","force_delete_category","force_delete_any_category","view_department","view_any_department","create_department","update_department","restore_department","restore_any_department","replicate_department","reorder_department","delete_department","delete_any_department","force_delete_department","force_delete_any_department","view_downloadable","view_any_downloadable","create_downloadable","update_downloadable","restore_downloadable","restore_any_downloadable","replicate_downloadable","reorder_downloadable","delete_downloadable","delete_any_downloadable","force_delete_downloadable","force_delete_any_downloadable","view_number","view_any_number","create_number","update_number","restore_number","restore_any_number","replicate_number","reorder_number","delete_number","delete_any_number","force_delete_number","force_delete_any_number","view_post","view_any_post","create_post","update_post","restore_post","restore_any_post","replicate_post","reorder_post","delete_post","delete_any_post","force_delete_post","force_delete_any_post","view_research","view_any_research","create_research","update_research","restore_research","restore_any_research","replicate_research","reorder_research","delete_research","delete_any_research","force_delete_research","force_delete_any_research","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_view","view_any_view","create_view","update_view","restore_view","restore_any_view","replicate_view","reorder_view","delete_view","delete_any_view","force_delete_view","force_delete_any_view","view_year::section","view_any_year::section","create_year::section","update_year::section","restore_year::section","restore_any_year::section","replicate_year::section","reorder_year::section","delete_year::section","delete_any_year::section","force_delete_year::section","force_delete_any_year::section","widget_StatsOverview","widget_ResearchChart","widget_PostChart","widget_DepartmentChart","widget_AdviserChart"]},{"name":"panel_user","guard_name":"web","permissions":[]},{"name":"editor","guard_name":"web","permissions":["view_adviser","view_any_adviser","create_adviser","update_adviser","restore_adviser","restore_any_adviser","replicate_adviser","reorder_adviser","delete_adviser","delete_any_adviser","view_category","view_any_category","create_category","update_category","restore_category","restore_any_category","replicate_category","reorder_category","delete_category","delete_any_category","view_department","view_any_department","create_department","update_department","restore_department","restore_any_department","replicate_department","reorder_department","delete_department","delete_any_department","view_downloadable","view_any_downloadable","create_downloadable","update_downloadable","restore_downloadable","restore_any_downloadable","replicate_downloadable","reorder_downloadable","delete_downloadable","delete_any_downloadable","view_post","view_any_post","create_post","update_post","restore_post","restore_any_post","replicate_post","reorder_post","delete_post","delete_any_post","view_research","view_any_research","create_research","update_research","restore_research","restore_any_research","replicate_research","reorder_research","delete_research","delete_any_research","view_year::section","view_any_year::section","create_year::section","update_year::section","restore_year::section","restore_any_year::section","replicate_year::section","reorder_year::section","delete_year::section","delete_any_year::section","widget_ResearchChart","widget_PostChart","widget_DepartmentChart","widget_AdviserChart"]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
