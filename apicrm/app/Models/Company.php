<?php

namespace App\Models;

// use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d H:i:s';
    protected $fillable = ['name'];

    public function addUser($user, $roles)
    {
        $newUser = $this->users()->create($user); // Создаем нового User
        $newUser->roles()->attach( $this->roles()->whereIn('slug', $roles)->get() ); // Задаем Roles
        $newUser->apps()->attach( App::whereDefault(TRUE)->get() ); // Отображение Apps в меню по-умолчанию
        if(in_array( 'owner', $roles )) $this->owners()->attach($newUser);
        return $newUser;
    }

    public function createNewWithOwner($company, $user)
    {   // TODO: Привести к последовательному вызову createWithDefaultRoles + addUser
        $newCompany = $this->create($company); // Создаем новую Company
        // TODO: Реализацию перенести в модель Role
        foreach( Role::defaultRoles()->get() as $def ){ // Копируем Roles по-умолчанию
            $new = $def->replicate();
            $new->company_id = $newCompany->id;
            $new->push();
            $new->perms()->attach($def->perms);
        }
        return $newCompany->addUser($user, ['owner']);
    }

    public function filials () {
        return $this->hasMany(Filial::class);
    }

    public function gang ($gang_id = false)  {
        if(!$gang_id) { abort(500, 'Отсутствует gang_id'); }
        return
            $this->gangs()->firstWhere('id', $gang_id)
            ?? abort(500, "Группа с id = {$gang_id} не найден");
    }
    public function gangs () {
        return $this->hasMany(Gang::class);
    }

    public function owners () {
        return $this->belongsToMany(User::class, 'owners', 'company_id', 'user_id');
    }

    public function roles () {
        return $this->hasMany(Role::class);
    }

    public function roleUser ($role, $user_id = false)
    {
        if(!$user_id) { abort(500, 'Отсутствует user_id'); }
        return $this->roleUsers($role)->firstWhere('users.id', $user_id)
            ?? abort(500, "Аккаунт с ролью '{$role}' и id = {$user_id} не найден");
    }
    public function roleUsers($role) {
        return $this->roles()->firstWhere('slug', $role)->users();
    }

    public function subject ($subject_id = false)
    {
        if(!$subject_id) { abort(500, 'Отсутствует subject_id'); }
        return $this->subjects()->firstWhere('id', $subject_id)
            ?? abort(500, "Предмет с id = {$subject_id} не найден");
    }
    public function subjects () {
        return $this->hasMany(Subject::class);
    }

    public function student ($student_id = false)
    {
        if(!$student_id) { abort(500, 'Отсутствует student_id'); }
        return $this->students()->firstWhere('users.id', $student_id)
            ?? abort(500, "Студент с id = {$student_id} не найден");
    }
    public function students() {
        return $this->roleUsers('student');
    }

    public function teacher ($user_id = false) {
        return $this->roleUser('teacher', $user_id);
    }
    public function teachers () {
        return $this->roleUsers('teacher');
    }

    public function users () {
        return $this->hasMany(User::class);
    }

}
