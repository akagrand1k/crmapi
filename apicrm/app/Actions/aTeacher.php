<?php

namespace App\Actions;

class aTeacher extends Action
{
    public function handle($company)
    {
        return $this->all($company);
    }

    public function all($company)
    {
        return $company->teachers()->get();
    }

    public function subjects($company, $teacher_id)
    {
        // return $company->teacher($teacher_id)->teacherSubjects()->toSql();
        return $company->teacher($teacher_id)->teacherSubjects()->get();
        //return $company->teachers()->firstWhere('users.id', $teacher_id)->subjects()->get();
    }

    public function tachSubject($act, $company, $teacher_id, $subject_id)
    {
        // if(!$teacher_id) abort(500, 'Нет обязательного параметра teacher_id');
        // if(!$subject_id) abort(500, 'Нет обязательного параметра subject_id');
        $teacher = $company->teacher($teacher_id); // TODO Teacher is not found
        $subject = $company->subject($subject_id); // TODO Subject is not found
        $teacher->teacherSubjects()->$act($subject->id);
        return $subject;
    }
}
