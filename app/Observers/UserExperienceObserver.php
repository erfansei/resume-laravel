<?php

namespace App\Observers;

use App\Models\userexperience;
use Illuminate\Support\Facades\Cache;

class UserExperienceObserver
{
    /**
     * Handle the userexperience "created" event.
     */
    public function creating(userexperience $userexperience): void
    {
        $userexperience->user_id = auth()->user()->id;
    }
    /**
     * Handle the userexperience "created" event.
     */
    public function created(userexperience $userexperience): void
    {
        Cache::forget('exps:' . auth()->user()->id);
    }

    /**
     * Handle the userexperience "updated" event.
     */
    public function updated(userexperience $userexperience): void
    {
        Cache::forget('exps:' . auth()->user()->id);
    }

    /**
     * Handle the userexperience "deleted" event.
     */
    public function deleted(userexperience $userexperience): void
    {
        Cache::forget('exps:' . auth()->user()->id);
    }

    /**
     * Handle the userexperience "restored" event.
     */
    public function restored(userexperience $userexperience): void
    {
        Cache::forget('exps:' . auth()->user()->id);
    }

    /**
     * Handle the userexperience "force deleted" event.
     */
    public function forceDeleted(userexperience $userexperience): void
    {
        Cache::forget('exps:' . auth()->user()->id);
    }
}
