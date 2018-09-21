<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /**
         * 預設管理員
         */
        // id = 1
        $defaultUser = [
            'name' => 'admin',
            'email' => 'admin@localhost.dev',
            'password' => bcrypt('12345678')
        ];

        /**
         * 預設角色
         */
        $defaultRoles = [
            '管理員', // id = 1
            '教師',
            '學生',
        ];

        /**
         * 預設權限
         */
        $defaultPermissions = [
            '後台管理', // id = 1
        ];



        $user = \Backpack\Base\app\Models\BackpackUser::create($defaultUser);


        foreach ($defaultRoles as $roleName) {
            \Backpack\PermissionManager\app\Models\Role::create(['name'=> $roleName]);
        }
        // 將 預設管理員 加入 管理員角色
        $user->assignRole($defaultRoles[0]);


        foreach ($defaultPermissions as $permissionName) {
            \Backpack\PermissionManager\app\Models\Permission::create(['name'=> $permissionName]);
        }
        // 將 管理員角色 加入 後台管理 權限
        \Backpack\PermissionManager\app\Models\Role::findByName($defaultRoles[0])->givePermissionTo($defaultPermissions[0]);

    }
}
