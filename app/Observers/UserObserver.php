<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Log;

class UserObserver
{
    public function creating(User $user)
    {
        $user->last_login = now();
    }
    
    /**
     * Handle the UserObserver "created" event.
     * 
     * @param
     * @return void
     */
    public function created(User $user)
    {
        Log::create([
            'module' => 'register',
            'action' => 'registrasi akun',
            'useraccess' => $user->email
        ]);
    }

        /**
     * Handle the UserObserver "updated" event.
     */
    public function updated(User $user)
    {
        Log::create([
            'module' => 'sunting',
            'action' => 'sunting akun',
            'useraccess' => $user->email
        ]);
    }

    public function deleting(User $user) {
        Log::create([
            'module' => 'delete',
            'action' => 'delete akun',
            'useraccess' => $user->email
        ]);
    }  
    

    /**
     * Handle the UserObserver "deleted" event.
     *
     * @param  \App\Models\UserObserver  $userObserver
     * @return void
     */
    public function deleted(UserObserver $userObserver)
    {
        //
    }

    /**
     * Handle the UserObserver "restored" event.
     *
     * @param  \App\Models\UserObserver  $userObserver
     * @return void
     */
    public function restored(UserObserver $userObserver)
    {
        //
    }

    /**
     * Handle the UserObserver "force deleted" event.
     *
     * @param  \App\Models\UserObserver  $userObserver
     * @return void
     */
    public function forceDeleted(UserObserver $userObserver)
    {
        //
    }
}