<?php

namespace App\Policies;

use App\Models\Guide;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GuidePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function destroy(User $user, Guide $guide)
    {
        return $user->id === $guide->user_id || $user->is_admin;
    }

}
