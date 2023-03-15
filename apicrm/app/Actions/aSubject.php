<?php

namespace App\Actions;

class aSubject extends Action
{
    protected $relations = ['gangs'=>'gang', 'teachers'=>'teacher'];

    public function handle($company){
        return $this->all($company);
    }

    public function all($company){
        return $company->subjects()->get();
    }

    public function create($company, $subject = NULL)
    {
        return $company->subjects()->create(
            $subject ?? ['name' => 'Новый предмет']
        );
    }

    public function patch($company, $id, $data)
    {
        $obj = $company->subjects()->whereId($id);
        return $obj->update($data) ? $obj->first() : FALSE;
    }

    public function delete($company, $subject_id)
    {
        return $company->subject($subject_id)->delete() ? TRUE : FALSE;
    }

    public function gangs($company, $subject_id)
    {
        // TODO: А если не такого Subject с $subject_id ?
        return $company->subject($subject_id)->gangs()->get();
    }

    public function teachers($company, $subject_id)
    {
        // TODO: А если не такого Subject с $subject_id ?
        return $company->subject($subject_id)->teachers()->get();
    }
}
