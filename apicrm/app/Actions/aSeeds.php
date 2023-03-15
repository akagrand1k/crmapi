<?php

namespace App\Actions;

class aSeeds extends Action
{
    public $N = [
        'filials' => 2,
        'places' => 2,

        'subjects' => [7, 11], // must have > 3

        'students' => 30,
        'gangs' => [5, 7],
        'gang_capacity' => [5, 7] // < students
    ];

    public function isUnique($users, $user) {
        for ($i=0, $count = count($users); $i < $count; $i++) {
            if($users[$i] == $user->id) {
                return false;
            }
        }
        return true;
    }

    public function makeTeachersForSubject($company, &$subjects, $Users, &$log)
    {
        $subjectsNum = count($subjects);

        $teachersNum = $subjectsNum + ceil($subjectsNum / 3);
        $log['  Учителя'] = $teachersNum + 2; // 2 - Безпредментые учителя

        $tmp = [];
        // Учителя которые могут вести более одного предмета
        $bank = $Users($company, ['teacher' => $subjectsNum])['teacher'];
        // Учителя которые будут вести только один предмет
        $vabank = $Users($company, ['teacher' => $teachersNum - $subjectsNum])['teacher'];
        // Безпредментые учителя
        $balast = $Users($company, ['teacher' => 2])['teacher'];

        for ($i=0; $i < $subjectsNum; $i++){
            // Обеспечиваем по одному предмету на учителя
            $tmp[] = [$bank[$i]['user']->id];

            // пытаемся дополнить более одного учителя (но не больше двух учителей) на предмет
            $more = mt_rand(0, 2);
            if($more > 0){
                $teachers = array_rand($bank, $more);
                $teachers = is_numeric($teachers) ? [$teachers] : $teachers;
                for ($j=0; $j < $more; $j++)
                {
                    //print_r($teachers);
                    $key = $teachers[$j];
                    if($this->isUnique(
                        $tmp[$i],
                        $bank[$teachers[$j]]['user']
                    ))
                    {
                        $tmp[$i][] = $bank[$teachers[$j]]['user']->id;
                    }
                }
            }

            if (count($vabank) > 0){
                $tmp[$i][] = array_pop($vabank)['user']->id;
            }

            $subjects[$i]->teachers()->attach($tmp[$i]);
        }
    }

    public function attachStudentsToGangs(&$gangs, $students)
    {
        foreach ($gangs as $gang) {
            $studentsNum = mt_rand(...$this->N['gang_capacity']);
            $keys = array_rand($students, $studentsNum);
            $ids = [];
            foreach ($keys as $key) {
                $ids[] = $students[$key]['user']->id;
            }
            $gang->users()->attach($ids);
        }
    }

    public function createEvents($subjects, $gangs, $students)
    {

    }

    public function handle()
    {
        $log = [];
        $timer = now();

        $Users = new aUserSeeds();

        $owner = $Users();
        $company = $owner['company'];
        $log['h2'] = $company->name;
        $log[' Owner phone'] = $owner['user']['phone'];

        aFilialSeeds::run($company, $this->N);
        $log[' Филиалы и Аудитории'] = "Создано {$this->N['filials']} филиала по {$this->N['places']} аудитории";

        $subjectsNum = mt_rand(...$this->N['subjects']);
        $subjects = aSubjectSeeds::run($company, $subjectsNum);
        $log[' Предметы'] = "Создано {$subjectsNum} предметов";

        $log[' Пользователи'] = '';
        $this->makeTeachersForSubject($company, $subjects, $Users, $log);

        $students = $Users($company, ['student' => $this->N['students']])['student'];
        $log['  Студенты'] = $this->N['students'];

        $roles = ['admin' => 1, 'admin,saleman' => 1, 'saleman' => 1];
        $Users($company, $roles);
        $log['  Остальные'] = json_encode($roles);

        $gangsNum = mt_rand(...$this->N['gangs']);
        $gangs = aGangSeeds::run($company, $gangsNum);
        $empty_gang = aGangSeeds::run($company, 1);
        $log[' Группы'] = $gangsNum + 1;

        $this->attachStudentsToGangs($gangs, $students);
        $this->attachGangsToSubjects($gangs, $subjects);
        $this->attachStudentsToSubjects($students, $subjects);

        // $this->createEvents($subjects, $gangs, $students);

        $log['Время генерации ' . $timer->diffInSeconds(now()).' сек'] = '';

        return $log;
    }

    public function attachGangsToSubjects($gangs, &$subjects)
    {
        $sKeys = array_rand($subjects, count($subjects) - 2);
        foreach ($sKeys as $sKey) {
            $gKeys = array_rand($gangs, mt_rand(1, count($gangs) - 2));
            if(!is_array($gKeys)) $gKeys = [$gKeys];
            $ids = [];
            foreach ($gKeys as $gKey) {
                $ids[] = $gangs[$gKey]->id;
            }
            $subjects[$sKey]->gangs()->attach($ids);
        }
    }

    public function attachStudentsToSubjects($students, &$subjects)
    {
        $sKeys = array_rand($subjects, ceil(count($subjects)/3));
        foreach ($sKeys as $sKey) {
            $pKeys = array_rand($students, mt_rand(1, 2));
            if(!is_array($pKeys)) $pKeys = [$pKeys];
            $ids = [];
            foreach ($pKeys as $pKey) {
                $ids[] = $students[$pKey]['user']->id;
            }
            $subjects[$sKey]->students()->attach($ids);
        }
    }
}
