<?php

namespace App\Http\Controllers;

use App\Actions\aTest;

use App\Models\App;
use App\Models\Perm;
use App\Models\Role;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Database\Seeders\AppsPermsRoles;

class QueryController extends Controller
{
    protected function pre($v) {
        echo '<pre>';
        print_r($v);
        echo '</pre>';
    }

    public function test(User $User) {
        return $User->whereId(1)->first()->company->filials()->with('places')->get()->toArray();
    }

    public function test999(Company $Company) {

        $uid = 1;
        $this->pre(User::whereId($uid)->first()->company->toArray());

        $cid = 1; $sid =1;
        $company = $Company->whereId($cid)->first();
        $this->pre($company->toArray());

        $subject = $company->subjects()->whereId($sid)->first();
        $this->pre($subject->toArray());

        $teachers = $subject->teachers()->get();
        //->teachers()->get();
        $this->pre($teachers->toArray());
    }
    public function test333() {
        //$apr = new AppsPermsRoles();

        $this->pre(AppsPermsRoles::seeds('Apps'));
        $this->pre(AppsPermsRoles::seeds('Perms'));
        $this->pre(AppsPermsRoles::seeds('Roles'));
        $this->pre(AppsPermsRoles::seeds('PermsRoles'));

        /* $this->pre($apr->apps);
        $this->pre($apr->perms);
        $this->pre($apr->roles);

        $this->pre($apr->getApps());
        $this->pre($apr->getPerms());
        $this->pre($apr->getRoles());
        $this->pre($apr->getRolesPerms()); */
    }
    public function test24(Request $rq, aTest $test)
    {
        $actions = [];
        $actions['run'] = aTest::run('ok');
        $actions['invoke'] = $test('ok');
        $actions['new'] = (new aTest())('ok');
        $this->pre($actions);
    }
    public function test22(Request $rq, User $users, App $apps, Perm $perm, Role $role, Company $company)
    {
        $user_id = 1;
        $company_id = 1;
        $rq->merge(['slug'=>'Pages', 'menu' => false]);

        $user = $users->find($user_id);
        $slug_role = 'student';
        $slug_app = 'Pages';
        $slug_perm = '*';
        $val = true;

        $newCompany = $company->create(['name' => 'test1']);
        $newUser = $newCompany->users()->create(['phone' => mt_rand(10000,99999), 'password' => '123456']);

        $this->pre($newUser->toArray());

    }


}
