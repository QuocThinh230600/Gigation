<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Throwable
     * @author Quốc Tuấn <contact.quoctuan@gmail.com>
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            DB::table('roles')->insert([
                'name'        => 'Super Administrator',
                'description' => 'The account has the highest administrator rights in the website',
                'status'      => 'on',
                'guard_name'  => 'web',
                'created_at'  => new \DateTime(),
                'updated_at'  => new \DateTime(),
            ]);

            $modules = array(
                "user",
                "role",
                "category",
                "news",
                "page",
                "content",
                "position",
                "image",
                "province",
                "district",
                "ward",
                "producer",
                "attribute",
                "product"
            );

            if (config('app.multi_language')) {
                $modules[] = "language";
            }

            foreach ($modules as $module) {
                DB::table('permissions')->insert(
                    [
                        ['name' => $module . '_create', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                        ['name' => $module . '_index', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                        ['name' => $module . '_edit', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                        ['name' => $module . '_destroy', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()]
                    ]
                );
            }

            // Module another CRUD generate
            DB::table('permissions')->insert(
                [
                    ['name' => 'contact_index', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'contact_reply', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'contact_destroy', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'backup_index', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'backup_create', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'backup_destroy', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'backup_download', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'config_edit', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'log_error_statistical', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'log_error_index', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'activity_index', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()],
                    ['name' => 'activity_destroy', 'guard_name' => 'web', 'created_at' => new \DateTime(), 'updated_at' => new \DateTime()]
                ]
            );

            // Role has permission
            $role_has_permissions = array();
            $totalPermission      = DB::table('permissions')->count();

            for ($i = 1; $i <= $totalPermission; $i++) {
                $role_has_permissions[] = array('permission_id' => $i, 'role_id' => 1);
            }

            DB::table('role_has_permissions')->insert($role_has_permissions);

            // Relationship with User
            $totalUser = DB::table('users')->count();

            for ($u = 1; $u <= $totalUser; $u++) {
                DB::table('model_has_roles')->insert(
                    ['role_id' => 1, 'model_type' => 'App\Models\User', 'model_id' => $u]
                );
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return abort(500, $e->getMessage());
        } catch (\Error $e) {
            DB::rollBack();
            return abort(500, $e->getMessage());
        }
    }
}
