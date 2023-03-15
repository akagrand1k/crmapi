<?php

namespace App\Actions;

class aGang extends Action
{
    public function handle($company)
    {
        return $this->all($company);
    }

    public function all($company)
    {
        return $company ? $company->gangs()->get() : [];
    }

    public function students($company, $gang_id = false)
    {
        return $company && $gang_id ? $company->gang($gang_id)->users()->get() : [];
    }

    public function subjects($company, $gang_id = false)
    {
        return $company && $gang_id ? $company->gang($gang_id)->subjects()->get() : [];
    }

    public function create($company, $gang = NULL)
    {
        return $company->gangs()->create(
            $gang ?? ['name' => 'Новая группа']
        );
    }

    public function patch($company, $id, $data)
    {
        $obj = $company->gangs()->whereId($id);
        return $obj->update($data) ? $obj->first() : FALSE;
    }

    public function delete($company, $gang_id)
    {
        return $company->gang($gang_id)->delete() ? TRUE : FALSE;
    }

    public function tachStudent($act, $company, $gang_id, $student_id)
    {
        $gang = $company->gang($gang_id); // TODO Gang is not found
        $student = $company->student($student_id); // TODO User is not found
        $gang->users()->$act($student->id);
        return $student;
    }

    public function tachSubject($act, $company, $gang_id, $subject_id)
    {
        $gang = $company->gang($gang_id);
        $subject = $company->subject($subject_id);
        $gang->subjects()->$act($subject->id);
        return $subject;
    }
}
