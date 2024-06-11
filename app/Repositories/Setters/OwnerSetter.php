<?php

namespace App\Repositories\Setters;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Common trait to define an OwnerSetter.
 */
trait OwnerSetter
{
    /**
     * Set current user as admin/owner of the entities.
     *
     * @param $model JoinsGroups|GroupMembers|GroupRoles
     */
    public static function setOwner($model, User $user)
    {
        $model->join($user);
        $model->grant($user, User::ROLE_ADMIN);
        $model->grant($user, User::ROLE_CREATOR);
    }

    public static function setCreator($model, User $userModel = null): bool
    {
        $user = $userModel ?? Auth::user();

        $model->creator_id = $user->id;
        return $model->save();
    }

    public static function setAuthor($model, User $userModel = null): bool
    {
        $user = $userModel ?? Auth::user();

        $model->author_id = $user->id;
        return $model->save();
    }
}
