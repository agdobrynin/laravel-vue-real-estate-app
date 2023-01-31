<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    use HandlesAuthorization;

    public function update(User $user, DatabaseNotification $databaseNotification)
    {
        return $databaseNotification->notifiable_id === $user->id
            ? Response::allow()
            : Response::deny('You are not owner this notification');
    }
}
