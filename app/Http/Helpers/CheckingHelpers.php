<?php

function checkRole($roleName)
{
    $roles = Auth::user()->userRoles;
    foreach ($roles as $role) {
        $userRoles[] = $role->role->name;
    }
    return in_array($roleName, $userRoles);
}

function checkStatus()
{
    $user = Auth::user();
    return $user->status != $user->statusName['block'];
}

function checkOwner($id)
{
    return Auth::user()->id == $id;
}

function checkLogin()
{
    return Auth::user() && Auth::user() != null;
}
