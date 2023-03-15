<?php

namespace App\Relations;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;
use App\Models\Perm;

class RelUserPerms extends Relation
{
    /** @var \App\Domain\Contract\Models\Contract|Illuminate\Database\Eloquent\Builder */
    protected $query;

    /** @var \App\Models\User */
    protected $parent;

    public function __construct(User $parent)
    {
        parent::__construct(Perm::query(), $parent);
    }

    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
        // perms > perm_role > identity_role > identities
        $this->query
            ->select('app_id','slug','name')
            ->groupBy('perms.app_id', 'perms.slug') // Скоуп к модели Perm
            ->join(
                'perm_role',
                'perm_role.perm_id',
                '=',
                'perms.id'
            )
            ->join(
                'role_user',
                'role_user.role_id',
                '=',
                'perm_role.role_id'
            );
    }
    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param array $models
     *
     * @return void
     */
    public function addEagerConstraints(array $users)
    {
        $this->query
            ->whereIn(
                'role_user.user_id',
                //'habitants.contact_id',
                collect($users)->pluck('id')
                //collect($people)->pluck('id')
            )
            ->with('role_user') //'habitants'
            ->select('perms.*'); // 'contracts.*'
    }
    /**
     * Initialize the relation on a set of models.
     *
     * @param array $models
     * @param string $relation
     *
     * @return array
     */
    public function initRelation(array $users, $relation)
    {
        foreach ($users as $user) {
            $user->setRelation(
                $relation,
                $this->related->newCollection()
            );
        }

        return $users;
    }
    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param array $models
     * @param \Illuminate\Database\Eloquent\Collection $results
     * @param string $relation
     *
     * @return array
     */
    public function match(array $users, Collection $perms, $relation)
    {
        if ($perms->isEmpty()) {
            return $users;
        }

        foreach ($users as $user) {
            $user->setRelation(
                $relation,
                $perms->filter(function (Perm $perm) use ($user) {
                    return $perm->role_user->pluck('user_id')->contains($user->id);
                    //return $contract->habitants->pluck('person_id')->contains($person->id);
                })
            );
        }

        return $users;
    }
    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->query->get();
    }

}
