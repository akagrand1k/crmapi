<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Role;
use App\Models\App;

class sSignUp
{
    protected function userToArray(User $user)
    {
        return [
            'user'      => $user,
            'company'   => $user->company()->first(),
            'roles'     => $user->roles()->get(),
            'apps'      => $user->apps()->get(),
            'perms'     => $user->perms()->get()
        ];
    }

    public function client(Request $request)
    {
        $app = new App(); $role = new Role(); $user = new User();

        $company_id = $request->user()->company_id;
        $request->merge(['company_id' => $company_id]);

        $roles = $request->input('roles', ['student']);

        // Создаем нового User
        $newUser = $user->create($request->all());

        // Задаем Roles
        $newUser->roles()->attach(
            $role->whereCompanyId($company_id)->whereIn('slug', $roles)->get()
        );

        // Отображение Apps в меню по-умолчанию
        $apps = $app->whereDefault(TRUE)->get();
        $newUser->apps()->attach($apps);

        //$newUser->load('company', 'roles');//,'apps','perms');

        return $this->userToArray($newUser);
    }

    public function owner(Request $request)
    {
        $app = new App(); $company = new Company(); $role = new Role(); $user = new User();
        // Создаем новую Company
        $newCompany = $company->create(['name' => $request->input('lastname', 'Школа')]);
        $request->merge(['company_id' => $newCompany->id]);

        // Создаем нового User
        $newUser = $user->create($request->all());

        // Обозначаем владельца Company
        $newCompany->owners()->attach($newUser);

        // Создать Roles по-умолчанию
        // $this->books->where('pivot.favourite', true);
        // $user->load(['books' => function ($query) {
        //    $query->where('favourite', true)->with('authors');
        // }]);
        $defs = $role->whereCompanyIdAndDefault(NULL, TRUE)->with('perms')->get();
        foreach($defs as $def){
            $new = $def->replicate();
            $new->company_id = $newCompany->id;
            $new->push();
            //$new->company()->attach($newCompany);
            $new->perms()->attach($def->perms);
        }
        // Задаем Role = Владелец
        $newUser->roles()->attach($role->whereCompanyIdAndSlug($newCompany->id, 'owner')->first());

        // Отображение Apps в меню по-умолчанию
        $apps = $app->whereDefault(TRUE)->get();
        $newUser->apps()->attach($apps);

        //$newUser->load('company', 'roles');//,'apps','perms');

        return $this->userToArray($newUser);
    }
}
