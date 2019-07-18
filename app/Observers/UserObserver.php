<?php

namespace App\Observers;

use App\Models\User\User;
use App\Services\LogService;
use App\Models\Bonus\BonusLog;
class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Models\User\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $logService = app(LogService::class);
        if($user->isDirty('bonus')){
            $properties = $logService->updateProperties($user->only(['bonus']),['bonus'=>$user->getOriginal('bonus')]);
            $description = $logService->updateDescription($properties,$keyCn=['bonus'=>'奖金']);
            $bonusLog = new BonusLog([
                'properties'=>$properties,
                'description'=>$description,
            ]);
            $bonusLog->user()->associate($user);
            $bonusLog->save();
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
