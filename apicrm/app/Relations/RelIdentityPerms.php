<?php

namespace App\Relations;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Identity;
use App\Models\Perm;

class RelIdentityPerms extends Relation
{
    /** @var \App\Domain\Contract\Models\Contract|Illuminate\Database\Eloquent\Builder */
    protected $query;

    /** @var \App\Models\Identity */
    protected $parent;

    public function __construct(Identity $parent)
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
                'identity_role',
                'identity_role.role_id',
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
    public function addEagerConstraints(array $identities)
    {
        $this->query
            ->whereIn(
                'identity_role.identity_id',
                //'habitants.contact_id',
                collect($identities)->pluck('id')
                //collect($people)->pluck('id')
            )
            ->with('identity_role') //'habitants'
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
    public function initRelation(array $identities, $relation)
    {
        foreach ($identities as $identity) {
            $identity->setRelation(
                $relation,
                $this->related->newCollection()
            );
        }

        return $identities;
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
    public function match(array $identities, Collection $perms, $relation)
    {
        if ($perms->isEmpty()) {
            return $identities;
        }

        foreach ($identities as $identity) {
            $identity->setRelation(
                $relation,
                $perms->filter(function (Perm $perm) use ($identity) {
                    return $perm->identity_role->pluck('identity_id')->contains($identity->id);
                    //return $contract->habitants->pluck('person_id')->contains($person->id);
                })
            );
        }

        return $identities;
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
