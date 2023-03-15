<?php

namespace Database\Seeders;

use Carbon\Carbon;

class AppsPermsRoles {

    protected static $obj = NULL;

    public $apps = [];

    public $perms = [];
    public $permDefault = ['*' => ['slug' => '*', 'name' => 'Полный доступ']];

    public $roles = [];


    public static function seeds ($name) {
        static::$obj = static::$obj ?? (new static());
        return static::$obj->$name();
    }

    public function __construct()
    {
        $dt = Carbon::now()->format('Y-m-d H:i:s');

        $this->apps = [
            [
                'slug'   => 'Pages',
                'name'   => 'Страницы',
                'config' => json_encode([
                    "path"      => "/pages",
                    "name"      => "Pages",
                    "component" => "Pages",
                    "meta"      => ["icon" => "link", "title" => "Страницы"]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'Users',
                'name'   => 'Аккаунты',
                'config' => json_encode([
                    "path"      => "/users",
                    "name"      => "Users",
                    "component" => "Users",
                    "meta"      => ["icon" => "manage_accounts", "title" => "Аккаунты",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'About',
                'name'   => 'О проекте',
                'config' => json_encode([
                    "path"      => "/about",
                    "name"      => "About",
                    "component" => "About",
                    "meta"      => ["icon" => "description", "title" => "О проекте"]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'Test',
                'name'   => 'Тестовый компонент',
                'config' => json_encode([
                    "path"      => "/test",
                    "name"      => "Test",
                    "component" => "Test",
                    "meta"      => ["icon" => "bug_report", "title" => "Тестовый компонент"]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'Roles',
                'name'   => 'Роли',
                'config' => json_encode([
                    "path"      => "/roles",
                    "name"      => "Roles",
                    "component" => "Roles",
                    "meta"      => ["icon" => "theater_comedy", "title" => "Роли",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'Company',
                'name'   => 'Филиалы',
                'config' => json_encode([
                    "path"      => "/company",
                    "name"      => "Company",
                    "component" => "Company",
                    "meta"      => ["icon" => "apartment", "title" => "Филиалы",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug'   => 'Course',
                'name'   => 'Курсы',
                'config' => json_encode([
                    "path"      => "/course",
                    "name"      => "Course",
                    "component" => "Course",
                    "meta"      => ["icon" => "menu_book", "title" => "Курсы",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug' => 'Teachers',
                'name' => 'Преподы',
                'config' => json_encode([
                    "path"      => "/teachers",
                    "name"      => "Teachers",
                    "component" => "Teachers",
                    "meta"      => ["icon" => "school", "title" => "Преподы",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ],[
                'slug' => 'Gangs',
                'name' => 'Группы',
                'config' => json_encode([
                    "path"      => "/gangs",
                    "name"      => "Gangs",
                    "component" => "Gangs",
                    "meta"      => ["icon" => "groups", "title" => "Группы",]
                ]),
                'created_at' => $dt,'updated_at' => $dt
            ]
        ];

        $this->perms = [
            'Users'=> [
                'read'   => ['slug' => 'read',   'name' => 'Только чтение'],
                'update' => ['slug' => 'update', 'name' => 'Редактирование']
            ]
        ];

        $app_id = 1; $perm_id =1;
        array_walk(
            $this->apps,
            function(&$app) use (&$app_id, &$perm_id) {
                //$app['id'] = $app_id++;
                $this->perms[$app['slug']] = $this->perms[$app['slug']] ?? $this->permDefault;
                array_walk(
                    $this->perms[$app['slug']],
                    function(&$perm) use (&$perm_id, $app_id) {
                        $perm['id'] = $perm_id++;
                        $perm['app_id'] = $app_id;
                    }
                );
                $app_id++;
            }
        );

        $this->roles = [
            [
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'student',
                    'name'          => 'Студент',
                    'description'   => '',
                    'created_at'    => $dt,
                    'updated_at'    => $dt
                ],
                'apps' => [
                    'About' => ['*']
                ]
            ],[
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'teacher',
                    'name'          => 'Учитель',
                    'description'   => '',
                    'created_at'    => $dt,
                    'updated_at'    => $dt
                ],
                'apps' => [
                    'Users' => ['read'],
                    'About' => ['*']
                ]
            ],[
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'admin',
                    'name'          => 'Администратор',
                    'description'   => 'Методист, Завуч',
                    'created_at'    => $dt,
                    'updated_at'    => $dt
                ],
                'apps' => [
                    'Users' => ['read', 'update'],
                    'Pages' => ['*'],
                    'About' => ['*']
                ]
            ],[
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'owner',
                    'name'          => 'Владелец',
                    'description'   => '',
                    'created_at'    => $dt,'updated_at' => $dt
                ],
                'apps' => [
                    'Company'   => ['*'],
                    'Course'    => ['*'],
                    'Teachers'  => ['*'],
                    'Gangs'     => ['*'],
                    'Users'     => ['read', 'update'],
                    'Roles'     => ['*'],
                    'Pages'     => ['*'],
                    'About'     => ['*']
                ]
            ],[
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'saleman',
                    'name'          => 'Менеджер по продажам',
                    'description'   => '',
                    'created_at'    => $dt,
                    'updated_at'    => $dt
                ],
                'apps' => [
                    'Users' => ['read', 'update'],
                    'Pages' => ['*'],
                    'About' => ['*']
                ]
            ],[
                'cnf' => [
                    'default'       => TRUE,
                    'slug'          => 'superadmin',
                    'name'          => 'СуперМен',
                    'description'   => 'Разработчики',
                    'created_at'    => $dt,
                    'updated_at'    => $dt
                ],
                'apps' => ['Test' => ['*'], 'About' => ['*']]
            ]
        ];

        $role_id = 1;
        array_walk(
            $this->roles,
            function(&$role) use (&$role_id) { $role['id'] = $role_id++; }
        );
    }

    public function Apps()
    {
        return $this->apps;
    }

    public function Perms()
    {
        $res = [];
        foreach ($this->perms as $app => $perms) {
            foreach ($perms as $perm) {
                $res[] = [
                    'app_id' => $perm['app_id'],
                    'slug' => $perm['slug'],
                    'name' => $perm['name'],
                ];
            }
        }
        return $res;
    }

    public function Roles()
    {
        return array_map(
            function($role){ return $role['cnf']; },
            $this->roles
        );
    }

    public function PermsRoles()
    {
        $res = [];
        foreach ($this->roles as $role) {
            foreach ($role['apps'] as $app => $perms) {
                foreach ($perms as $perm) {
                   $res[] = [
                       'role_id' => $role['id'],
                       'perm_id' => $this->perms[$app][$perm]['id']
                   ];
                }
            }
        }
        return $res;
    }
}
