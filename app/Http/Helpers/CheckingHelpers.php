<?php

function checkRole($roleName)
{
    if (!is_null(Auth::user())) {
        $roles = Auth::user()->userRoles;
        foreach ($roles as $role) {
            $userRoles[] = $role->role->name;
        }

        return in_array($roleName, $userRoles);
    }
    return false;
}

function checkStatus()
{
    $user = Auth::user();
    return $user->status != $user->statusName['block'];
}

function checkOwner($id)
{
    return Auth::id() == $id;
}

function checkAdmin($user, $roleName)
{
    $result = false;
    foreach ($user->userRoles as $role) {
        if ($role->role->name == $roleName) {
            $result = true;
        }
    }
    return $result;
}
