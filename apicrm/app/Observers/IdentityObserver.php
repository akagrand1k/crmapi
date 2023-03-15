<?php

namespace App\Observers;

use App\Models\Identity;

class IdentityObserver
{
    /**
     * Handle the Identity "created" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function created(Identity $identity)
    {
        //
    }

    /**
     * Handle the Identity "updated" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function updated(Identity $identity)
    {
        //
    }

    /**
     * Handle the Identity "deleted" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function deleted(Identity $identity)
    {
        //
    }

    /**
     * Handle the Identity "restored" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function restored(Identity $identity)
    {
        //
    }

    /**
     * Handle the Identity "force deleted" event.
     *
     * @param  \App\Models\Identity  $identity
     * @return void
     */
    public function forceDeleted(Identity $identity)
    {
        //
    }
}
