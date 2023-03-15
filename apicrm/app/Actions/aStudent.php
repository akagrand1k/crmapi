<?php

namespace App\Actions;

class aStudent extends Action
{
    public function handle($company)
    {
        return $this->all($company);
    }

    public function all($company)
    {
        return $company->students()->get();
    }

    public function gangs($company, $student_id)
    {
        return $company->student($student_id)->gangs()->get();
    }
}
