<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function adminOrWorker(User $user)
    {
        if ($user->role_id == 3 || $user->role_id == 2) {
            return true;
        } else {
            return false;
        }
    }
}
